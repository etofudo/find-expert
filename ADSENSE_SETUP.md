# Google AdSense Setup Guide

## Step 1: Get Your AdSense Account
1. Go to [Google AdSense](https://www.google.com/adsense/)
2. Sign up for an AdSense account
3. Get approved (this may take a few days to weeks)

## Step 2: Create Ad Units
1. In your AdSense dashboard, go to "Ads" → "By ad unit"
2. Create the following ad units:

### Header Ad Unit
- **Name**: FindExpert Header
- **Size**: Responsive
- **Placement**: Header

### Sidebar Ad Unit
- **Name**: FindExpert Sidebar
- **Size**: 300x250 (Medium Rectangle)
- **Placement**: Sidebar

### Between Listings Ad Unit
- **Name**: FindExpert Between Listings
- **Size**: Responsive
- **Placement**: Content

### Profile Page Ad Unit
- **Name**: FindExpert Profile Page
- **Size**: 300x250 (Medium Rectangle)
- **Placement**: Sidebar

### Footer Ad Unit
- **Name**: FindExpert Footer
- **Size**: Responsive
- **Placement**: Footer

## Step 3: Get Your Publisher ID and Slot IDs
After creating ad units, you'll get:
- **Publisher ID**: ca-pub-XXXXXXXXXX
- **Slot IDs**: For each ad unit (e.g., 1234567890)

## Step 4: Update Your .env File
Add these lines to your `findexpert.com.ng/.env` file:

```env
# Google AdSense Configuration
ADSENSE_ENABLED=true
ADSENSE_PUBLISHER_ID=your_publisher_id_here

# Ad Unit Slot IDs
ADSENSE_HEADER_SLOT=your_header_slot_id
ADSENSE_SIDEBAR_SLOT=your_sidebar_slot_id
ADSENSE_LISTINGS_SLOT=your_listings_slot_id
ADSENSE_PROFILE_SLOT=your_profile_slot_id
ADSENSE_FOOTER_SLOT=your_footer_slot_id
```

## Step 5: Test Your Ads
1. Clear your cache: `php artisan config:clear`
2. Visit your website
3. Check that ads appear in the correct locations
4. Use AdSense preview tool to verify ads are working

## Step 6: Monitor Performance
- Check your AdSense dashboard regularly
- Monitor click-through rates (CTR)
- Optimize ad placement based on performance

## Revenue Expectations
- **Nigerian traffic**: $0.10 - $0.50 per 1000 page views
- **Construction niche**: Higher CPC due to commercial intent
- **Expected monthly revenue**: $50 - $500 (depending on traffic)

## Tips for Better Revenue
1. **High-quality content** attracts better ads
2. **Mobile optimization** increases mobile ad revenue
3. **Page load speed** affects ad performance
4. **User engagement** improves ad relevance

## Troubleshooting
- **Ads not showing**: Check if AdSense is approved and configured correctly
- **Low revenue**: Focus on increasing traffic and user engagement
- **Ad placement issues**: Adjust CSS or ad unit configurations
