<?php
namespace App\Services;

use App\Models\Expert;
use App\Models\Category;
use App\Models\State;
use App\Models\Lga;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Cloudinary\Api\Upload\UploadApi;

class OptimizedScrapingService
{
    private $client;
    private $uploadApi;
    private $batchSize = 5; // Small batches for shared hosting
    private $delayBetweenRequests = 2; // 2 seconds delay
    
    public function __construct()
    {
        $this->client = new Client([
            'timeout' => 10,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
            ]
        ]);
        
        $this->uploadApi = new UploadApi();
    }

    /**
     * Scrape Google My Business for Lagos construction companies
     * Optimized for shared hosting limitations
     */
    public function scrapeGoogleMyBusinessBatch($searchTerm, $location = 'Lagos, Nigeria', $limit = 20)
    {
        try {
            // Use Google Places API instead of scraping (more reliable on shared hosting)
            $placesUrl = "https://maps.googleapis.com/maps/api/place/textsearch/json";
            $query = urlencode($searchTerm . ' ' . $location);
            
            $response = $this->client->get($placesUrl, [
                'query' => [
                    'query' => $query,
                    'key' => env('GOOGLE_PLACES_API_KEY'), // You'll need this API key
                    'type' => 'establishment',
                    'region' => 'ng'
                ]
            ]);
            
            $data = json_decode($response->getBody(), true);
            
            if (!isset($data['results'])) {
                return [];
            }
            
            $experts = [];
            $processed = 0;
            
            foreach ($data['results'] as $place) {
                if ($processed >= $limit) break;
                
                // Memory management for shared hosting
                if (memory_get_usage() > 50 * 1024 * 1024) { // 50MB limit
                    Log::warning('Memory limit approached, stopping batch');
                    break;
                }
                
                $expert = $this->processGooglePlace($place);
                if ($expert) {
                    $experts[] = $expert;
                    $processed++;
                }
                
                // Delay to avoid rate limiting
                sleep($this->delayBetweenRequests);
            }
            
            return $experts;
            
        } catch (\Exception $e) {
            Log::error('Google scraping failed: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Process individual Google Place data
     */
    private function processGooglePlace($place)
    {
        try {
            // Get detailed place information
            $placeId = $place['place_id'];
            $detailsUrl = "https://maps.googleapis.com/maps/api/place/details/json";
            
            $response = $this->client->get($detailsUrl, [
                'query' => [
                    'place_id' => $placeId,
                    'key' => env('GOOGLE_PLACES_API_KEY'),
                    'fields' => 'name,formatted_address,formatted_phone_number,website,photos,rating,user_ratings_total,business_status,types'
                ]
            ]);
            
            $details = json_decode($response->getBody(), true);
            
            if (!isset($details['result'])) {
                return null;
            }
            
            $place = $details['result'];
            
            // Check if already exists (avoid duplicates)
            $existingExpert = Expert::where('phone', $place['formatted_phone_number'] ?? '')
                                  ->orWhere('name', $place['name'])
                                  ->first();
            
            if ($existingExpert) {
                return null; // Skip duplicates
            }
            
            // Determine category from business types
            $category = $this->determineCategory($place['types'] ?? [], $place['name']);
            
            // Extract location data
            $locationData = $this->extractLocationData($place['formatted_address'] ?? '');
            
            // Process images using Cloudinary (no EXIF needed!)
            $profileImage = null;
            if (isset($place['photos'][0])) {
                $profileImage = $this->uploadToCloudinary($place['photos'][0]);
            }
            
            return [
                'name' => $place['name'],
                'slug' => \Illuminate\Support\Str::slug($place['name']),
                'phone' => $this->cleanPhoneNumber($place['formatted_phone_number'] ?? ''),
                'email' => $this->extractEmailFromWebsite($place['website'] ?? ''),
                'website' => $place['website'] ?? null,
                'address' => $place['formatted_address'] ?? '',
                'state_id' => $locationData['state_id'],
                'lga_id' => $locationData['lga_id'],
                'category_id' => $category['id'],
                'rating' => $place['rating'] ?? 0,
                'total_reviews' => $place['user_ratings_total'] ?? 0,
                'profile_image' => $profileImage,
                'description' => $this->generateDescription($place['name'], $category['name']),
                'status' => $place['business_status'] === 'OPERATIONAL' ? 'active' : 'inactive',
                'data_source' => 'google_places',
                'google_place_id' => $placeId
            ];
            
        } catch (\Exception $e) {
            Log::error('Failed to process place: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Upload images to Cloudinary (solves EXIF and hosting limitations)
     */
    private function uploadToCloudinary($photoReference)
    {
        try {
            // Get photo URL from Google Places
            $photoUrl = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=800&photo_reference={$photoReference}&key=" . env('GOOGLE_PLACES_API_KEY');
            
            // Upload directly to Cloudinary from URL
            $result = $this->uploadApi->upload($photoUrl, [
                'folder' => 'findexpert/profiles',
                'transformation' => [
                    'width' => 400,
                    'height' => 300,
                    'crop' => 'fill',
                    'quality' => 'auto',
                    'format' => 'webp' // Modern format for faster loading
                ]
            ]);
            
            return $result['secure_url'];
            
        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Smart category detection from business types and names
     */
    private function determineCategory($types, $businessName)
    {
        $categoryMappings = [
            // Google Place types to our categories
            'electrician' => 'Electrical Contractors',
            'plumber' => 'Plumbers',
            'general_contractor' => 'Builders',
            'roofing_contractor' => 'Roofing Contractors',
            'painter' => 'Painters and Decorators',
            'home_improvement_store' => 'Builders Merchants',
            'hardware_store' => 'Hardware Suppliers',
            'moving_company' => 'Property Maintenance',
        ];
        
        // Check business types first
        foreach ($types as $type) {
            if (isset($categoryMappings[$type])) {
                return Category::firstOrCreate(
                    ['name' => $categoryMappings[$type]], 
                    ['slug' => \Illuminate\Support\Str::slug($categoryMappings[$type])]
                );
            }
        }
        
        // Fallback: analyze business name
        $nameKeywords = [
            'electric' => 'Electrical Contractors',
            'plumb' => 'Plumbers',
            'build' => 'Builders',
            'construct' => 'Builders',
            'roof' => 'Roofing Contractors',
            'paint' => 'Painters and Decorators',
            'tiles' => 'Tiling Contractors',
            'steel' => 'Steel Fabricators',
            'cement' => 'Builders Merchants',
            'architect' => 'Architects',
        ];
        
        $businessNameLower = strtolower($businessName);
        foreach ($nameKeywords as $keyword => $categoryName) {
            if (strpos($businessNameLower, $keyword) !== false) {
                return Category::firstOrCreate(
                    ['name' => $categoryName], 
                    ['slug' => \Illuminate\Support\Str::slug($categoryName)]
                );
            }
        }
        
        // Default category
        return Category::firstOrCreate(
            ['name' => 'General Contractors'], 
            ['slug' => 'general-contractors']
        );
    }

    /**
     * Extract location data from address
     */
    private function extractLocationData($address)
    {
        // Parse Nigerian addresses
        $stateMappings = [
            'lagos' => 'Lagos',
            'abuja' => 'FCT',
            'port harcourt' => 'Rivers',
            'kano' => 'Kano',
            'ibadan' => 'Oyo',
            'benin' => 'Edo',
            'enugu' => 'Enugu',
            'kaduna' => 'Kaduna'
        ];
        
        $addressLower = strtolower($address);
        
        foreach ($stateMappings as $keyword => $stateName) {
            if (strpos($addressLower, $keyword) !== false) {
                $state = State::firstOrCreate(
                    ['name' => $stateName], 
                    ['slug' => \Illuminate\Support\Str::slug($stateName)]
                );
                
                // Try to extract LGA (Local Government Area)
                $lga = $this->extractLGA($address, $state->id);
                
                return [
                    'state_id' => $state->id,
                    'lga_id' => $lga ? $lga->id : null
                ];
            }
        }
        
        // Default to Lagos if can't determine
        $defaultState = State::firstOrCreate(
            ['name' => 'Lagos'], 
            ['slug' => 'lagos']
        );
        return [
            'state_id' => $defaultState->id,
            'lga_id' => null
        ];
    }

    /**
     * Shared hosting friendly batch processing
     */
    public function runScrapingBatch($searchTerms = [])
    {
        $defaultSearchTerms = [
            'builders Lagos',
            'electricians Lagos',
            'plumbers Lagos',
            'architects Lagos',
            'roofers Lagos'
        ];
        
        $searchTerms = empty($searchTerms) ? $defaultSearchTerms : $searchTerms;
        
        foreach ($searchTerms as $term) {
            // Process small batches to avoid timeouts
            $experts = $this->scrapeGoogleMyBusinessBatch($term, 'Lagos, Nigeria', 5);
            
            foreach ($experts as $expertData) {
                try {
                    Expert::create($expertData);
                    Log::info("Created expert: " . $expertData['name']);
                } catch (\Exception $e) {
                    Log::error("Failed to create expert: " . $e->getMessage());
                }
            }
            
            // Break between search terms to avoid overloading
            sleep(5);
            
            // Check execution time (shared hosting usually has 30-60 second limits)
            if (time() - $_SERVER['REQUEST_TIME'] > 25) {
                Log::info('Approaching execution time limit, stopping batch');
                break;
            }
        }
    }

    /**
     * Clean and standardize phone numbers
     */
    private function cleanPhoneNumber($phone)
    {
        // Remove spaces, dashes, parentheses
        $clean = preg_replace('/[^\d+]/', '', $phone);
        
        // Convert to Nigerian format
        if (strpos($clean, '+234') === 0) {
            return $clean;
        } elseif (strpos($clean, '234') === 0) {
            return '+' . $clean;
        } elseif (strpos($clean, '0') === 0) {
            return '+234' . substr($clean, 1);
        }
        
        return $clean;
    }

    /**
     * Generate basic description for experts
     */
    private function generateDescription($name, $category)
    {
        $templates = [
            'Builders' => "{$name} is a professional building contractor in Lagos, Nigeria. We provide comprehensive construction services including residential and commercial building projects.",
            'Electrical Contractors' => "{$name} offers professional electrical services in Lagos. Our certified electricians handle installations, repairs, and maintenance for homes and businesses.",
            'Plumbers' => "{$name} provides reliable plumbing services across Lagos. From repairs to new installations, we ensure quality workmanship for all plumbing needs."
        ];
        
        return $templates[$category] ?? "{$name} is a trusted {$category} service provider in Lagos, Nigeria. Contact us for professional and reliable services.";
    }

    /**
     * Extract LGA from address (simplified for shared hosting)
     */
    private function extractLGA($address, $stateId)
    {
        // Simplified LGA extraction - you can expand this
        $lgaKeywords = [
            'ikeja' => 'Ikeja',
            'victoria island' => 'Victoria Island',
            'lekki' => 'Lekki',
            'surulere' => 'Surulere',
            'yaba' => 'Yaba'
        ];
        
        $addressLower = strtolower($address);
        
        foreach ($lgaKeywords as $keyword => $lgaName) {
            if (strpos($addressLower, $keyword) !== false) {
                return Lga::firstOrCreate([
                    'name' => $lgaName,
                    'state_id' => $stateId
                ], [
                    'slug' => \Illuminate\Support\Str::slug($lgaName)
                ]);
            }
        }
        
        return null;
    }

    /**
     * Extract email from website (simplified)
     */
    private function extractEmailFromWebsite($website)
    {
        // This would require additional HTTP requests to scrape websites
        // For shared hosting, we'll skip this to avoid timeouts
        return null;
    }
}