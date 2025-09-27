<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google AdSense Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Google AdSense integration
    |
    */

    'enabled' => env('ADSENSE_ENABLED', false),
    'publisher_id' => env('ADSENSE_PUBLISHER_ID', ''),
    
    // Ad unit configurations
    'ad_units' => [
        'header' => [
            'slot_id' => env('ADSENSE_HEADER_SLOT', ''),
            'format' => 'auto',
            'responsive' => true,
        ],
        'sidebar' => [
            'slot_id' => env('ADSENSE_SIDEBAR_SLOT', ''),
            'format' => 'auto',
            'responsive' => true,
        ],
        'between_listings' => [
            'slot_id' => env('ADSENSE_LISTINGS_SLOT', ''),
            'format' => 'auto',
            'responsive' => true,
        ],
        'profile_page' => [
            'slot_id' => env('ADSENSE_PROFILE_SLOT', ''),
            'format' => 'auto',
            'responsive' => true,
        ],
        'footer' => [
            'slot_id' => env('ADSENSE_FOOTER_SLOT', ''),
            'format' => 'auto',
            'responsive' => true,
        ],
    ],
    
    // Ad display settings
    'display' => [
        'show_on_homepage' => true,
        'show_on_listings' => true,
        'show_on_profiles' => true,
        'show_on_categories' => true,
        'show_on_locations' => true,
    ],
];
