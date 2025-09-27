# Backfill Expert Images

This command fetches Google Places photos and uploads them to Cloudinary for experts missing a `profile_image`.

## Requirements
- GOOGLE_PLACES_API_KEY set and billing enabled
- Cloudinary SDK configured (CLOUDINARY_URL in .env)

## Run on hosting
```bash
php artisan experts:backfill-images --limit=100 --delay=400
```

Options:
- `--limit` Number of experts to process (default 100)
- `--delay` Milliseconds between requests (default 300)
- `--dry-run` Preview without saving

Examples:
```bash
php artisan experts:backfill-images --limit=50 --dry-run
php artisan experts:backfill-images --limit=200 --delay=600
```

If an expert has no available photo or an upload fails, the command skips and continues.
