<?php

namespace App\Console\Commands;

use App\Models\Expert;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BackfillExpertImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'experts:backfill-images {--limit=100} {--delay=300} {--dry-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backfill expert profile images using Google Places photos and upload to Cloudinary.';

    /** @var Client */
    private $http;

    public function __construct()
    {
        parent::__construct();
        $this->http = new Client([
            'timeout' => 30,
            'http_errors' => false,
        ]);
    }

    public function handle(): int
    {
        $apiKey = env('GOOGLE_PLACES_API_KEY');
        if (!$apiKey) {
            $this->error('GOOGLE_PLACES_API_KEY is not set in .env');
            return self::FAILURE;
        }

        $limit = (int) $this->option('limit');
        $delayMs = (int) $this->option('delay');
        $dryRun = (bool) $this->option('dry-run');

        $query = Expert::query()
            ->where(function ($q) {
                $q->whereNull('profile_image')->orWhere('profile_image', '');
            })
            ->whereNotNull('google_place_id')
            ->limit($limit);

        $total = $query->count();
        if ($total === 0) {
            $this->info('No experts found needing backfill.');
            return self::SUCCESS;
        }

        $this->info("Processing {$total} experts (limit={$limit}, delay={$delayMs}ms, dryRun=" . ($dryRun ? 'yes' : 'no') . ")...");

        $processed = 0;
        foreach ($query->cursor() as $expert) {
            $processed++;
            try {
                $placeId = $expert->google_place_id;

                // 1) Get photo_reference via Place Details API
                $detailsUrl = 'https://maps.googleapis.com/maps/api/place/details/json';
                $detailsResp = $this->http->get($detailsUrl, [
                    'query' => [
                        'place_id' => $placeId,
                        'fields'   => 'photos',
                        'key'      => $apiKey,
                    ],
                ]);

                $details = json_decode((string) $detailsResp->getBody(), true);
                $status = $details['status'] ?? 'UNKNOWN';
                if ($status !== 'OK') {
                    $this->warn("[{$expert->id}] No photos (status={$status}). Skipping.");
                    usleep($delayMs * 1000);
                    continue;
                }

                $photos = $details['result']['photos'] ?? [];
                if (count($photos) === 0) {
                    $this->warn("[{$expert->id}] No photo entries in Place Details. Skipping.");
                    usleep($delayMs * 1000);
                    continue;
                }

                $photoRef = $photos[0]['photo_reference'] ?? null;
                if (!$photoRef) {
                    $this->warn("[{$expert->id}] photo_reference missing. Skipping.");
                    usleep($delayMs * 1000);
                    continue;
                }

                // 2) Build Places Photo URL (Google serves via redirect)
                $photoUrl = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=1024&photo_reference=' . urlencode($photoRef) . '&key=' . urlencode($apiKey);

                if ($dryRun) {
                    $this->line("[DRY] Would upload for expert #{$expert->id} from {$photoUrl}");
                    usleep($delayMs * 1000);
                    continue;
                }

                // 3) Upload to Cloudinary by remote fetch
                $secureUrl = $this->uploadToCloudinary($photoUrl, $expert);
                if (!$secureUrl) {
                    $this->warn("[{$expert->id}] Cloudinary upload failed. Skipping.");
                    usleep($delayMs * 1000);
                    continue;
                }

                // 4) Save profile_image
                $expert->profile_image = $secureUrl;
                $expert->save();

                $this->info("[{$expert->id}] Updated profile_image");
            } catch (\Throwable $e) {
                Log::error('Backfill image error', [
                    'expert_id' => $expert->id,
                    'message' => $e->getMessage(),
                ]);
                $this->error("[{$expert->id}] Error: {$e->getMessage()}");
            }

            usleep($delayMs * 1000);
        }

        $this->info("Done. Processed {$processed} experts.");
        return self::SUCCESS;
    }

    private function uploadToCloudinary(string $remoteUrl, Expert $expert): ?string
    {
        try {
            // Use unsigned upload with preset (preferred method)
            $unsignedPreset = env('CLOUDINARY_UPLOAD_PRESET');
            if ($unsignedPreset) {
                $cloudinaryUrl = env('CLOUDINARY_URL');
                if (!$cloudinaryUrl) {
                    $this->error('CLOUDINARY_URL missing in .env');
                    return null;
                }

                $parts = parse_url($cloudinaryUrl);
                $cloudName = $parts['host'] ?? null;
                if (!$cloudName) {
                    $this->error('CLOUDINARY_URL is malformed. Expect cloudinary://api_key:api_secret@cloud_name');
                    return null;
                }

                $publicId = 'experts/' . ($expert->slug ?: ('expert-' . $expert->id));
                $folder = 'findexpert';

                // Unsigned upload: no signature needed
                $endpoint = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";
                $resp = $this->http->post($endpoint, [
                    'form_params' => [
                        'file' => $remoteUrl,
                        'upload_preset' => $unsignedPreset,
                        'public_id' => $publicId,
                        'folder' => $folder,
                    ],
                ]);

                $data = json_decode((string) $resp->getBody(), true);
                if (isset($data['secure_url'])) {
                    return $data['secure_url'];
                } else {
                    Log::warning('Cloudinary unsigned upload unexpected response', ['body' => $resp->getBody()]);
                    return null;
                }
            }

            // Fallback: SDK v2 (signed upload)
            if (class_exists('Cloudinary\\Uploader')) {
                $publicId = 'experts/' . ($expert->slug ?: ('expert-' . $expert->id));
                $result = \Cloudinary\Uploader::upload($remoteUrl, [
                    'public_id' => $publicId,
                    'overwrite' => true,
                    'folder' => 'findexpert',
                    'invalidate' => true,
                ]);
                return $result['secure_url'] ?? null;
            }

            // Fallback: REST API (signed upload)
            $cloudinaryUrl = env('CLOUDINARY_URL');
            if (!$cloudinaryUrl) {
                $this->error('CLOUDINARY_URL missing in .env');
                return null;
            }

            $parts = parse_url($cloudinaryUrl);
            // Format: scheme://api_key:api_secret@cloud_name
            $apiKey = $parts['user'] ?? null;
            $apiSecret = $parts['pass'] ?? null;
            $cloudName = $parts['host'] ?? null;
            if (!$apiKey || !$apiSecret || !$cloudName) {
                $this->error('CLOUDINARY_URL is malformed. Expect cloudinary://api_key:api_secret@cloud_name');
                return null;
            }

            $publicId = 'experts/' . ($expert->slug ?: ('expert-' . $expert->id));
            $folder = 'findexpert';
            $timestamp = time();


            // Signed upload
            // Build signature for required params: folder, public_id, timestamp
            $toSign = http_build_query([
                'folder' => $folder,
                'public_id' => $publicId,
                'timestamp' => $timestamp,
            ], '', '&', PHP_QUERY_RFC3986);
            // Ensure lexicographical order (folder, public_id, timestamp already sorted)
            $signature = sha1($toSign . $apiSecret);

            $endpoint = "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload";
            $resp = $this->http->post($endpoint, [
                'form_params' => [
                    'file' => $remoteUrl,
                    'api_key' => $apiKey,
                    'timestamp' => $timestamp,
                    'public_id' => $publicId,
                    'folder' => $folder,
                    'signature' => $signature,
                ],
            ]);

            $data = json_decode((string) $resp->getBody(), true);
            if (!is_array($data) || ($data['secure_url'] ?? null) === null) {
                Log::warning('Cloudinary REST upload unexpected response', ['body' => (string) $resp->getBody()]);
                return null;
            }

            return $data['secure_url'];
        } catch (\Throwable $e) {
            Log::error('Cloudinary upload failed', [
                'expert_id' => $expert->id,
                'message' => $e->getMessage(),
            ]);
            return null;
        }
    }
}
