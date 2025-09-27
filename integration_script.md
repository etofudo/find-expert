# FindExpert Integration Script

## Files to Copy from New App to Existing findexpert.com.ng

### 1. MODELS (app/Models/)
Copy these files to: `findexpert.com.ng/app/Models/`
- Expert.php
- Category.php  
- State.php
- Lga.php
- ExpertGallery.php

### 2. CONTROLLERS (app/Http/Controllers/)
Copy these files to: `findexpert.com.ng/app/Http/Controllers/`
- HomeController.php
- ExpertController.php
- AdminController.php
- CategoryController.php
- LocationController.php

### 3. SERVICES (app/Http/Services/)
Create directory: `findexpert.com.ng/app/Http/Services/`
Copy this file to: `findexpert.com.ng/app/Http/Services/`
- NoApiScrapingService.php (our Google API scraper)

### 4. MIGRATIONS (database/migrations/)
Copy these files to: `findexpert.com.ng/database/migrations/`
- 2024_01_01_000001_create_states_table.php
- 2024_01_01_000002_create_lgas_table.php
- 2024_01_01_000003_create_categories_table.php
- 2024_01_01_000004_create_experts_table.php
- 2024_01_01_000005_create_expert_galleries_table.php

### 5. SEEDERS (database/seeders/)
Copy this file to: `findexpert.com.ng/database/seeders/`
- InitialDataSeeder.php

### 6. VIEWS (resources/views/)
Create these directories in: `findexpert.com.ng/resources/views/`
- layouts/
- admin/
- experts/
- categories/
- locations/

Copy these files:
- layouts/app.blade.php
- home.blade.php
- admin/dashboard.blade.php
- admin/scrape.blade.php
- experts/index.blade.php
- experts/show.blade.php
- categories/show.blade.php
- locations/state.blade.php
- locations/lga.blade.php

### 7. ROUTES (routes/web.php)
REPLACE the entire content of: `findexpert.com.ng/routes/web.php`

### 8. UPDATE .env FILE
Add these lines to: `findexpert.com.ng/.env`
```
# Google Places API (add when you get it)
GOOGLE_PLACES_API_KEY=

# Scraping settings
SCRAPING_DELAY=3
MAX_IMAGES_PER_EXPERT=5
```

## POST-INTEGRATION COMMANDS
After copying all files, run these commands on your hosting:

```bash
cd findexpert.com.ng
php artisan migrate
php artisan db:seed --class=InitialDataSeeder
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## TESTING CHECKLIST
After integration, test these URLs:
- https://findexpert.com.ng/ (homepage)
- https://findexpert.com.ng/experts (expert listings)
- https://findexpert.com.ng/admin (admin dashboard)
- https://findexpert.com.ng/admin/scrape (scraping interface)
