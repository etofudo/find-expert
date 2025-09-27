# FindExpert Deployment Guide

## 🚀 Quick Deployment to Linux Shared Hosting

### 1. Upload Files to Your Hosting
Upload all files from your local `FindExpert` folder to your hosting's `public_html` directory.

### 2. Set Up Environment Variables
Create a `.env` file on your hosting with these settings:

```env
APP_NAME=FindExpert
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY_HERE
APP_DEBUG=false
APP_URL=https://findexpert.com.ng

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=barnesbu_findexpert_ng
DB_USERNAME=barnesbu_findexpert
DB_PASSWORD=Mula=65HelpMe

# Google Places API (Get from Google Cloud Console)
GOOGLE_PLACES_API_KEY=your_google_places_api_key_here

# Cloudinary (Already configured)
CLOUDINARY_URL=cloudinary://674998678129896:ILIn5ZHUV1PMmpC1UpM1h7BdkYg@dc4hye5ug
```

### 3. Install Dependencies
SSH into your hosting and run:
```bash
cd public_html
composer install --no-dev --optimize-autoloader
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Run Database Migrations
```bash
php artisan migrate
php artisan db:seed --class=InitialDataSeeder
```

### 6. Set Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 7. Get Google Places API Key
1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Create a new project or select existing
3. Enable "Places API"
4. Create credentials → API Key
5. Add the key to your `.env` file

### 8. Test Your Site
Visit: https://findexpert.com.ng

## 🎯 Expected Revenue (Nigerian Market)

**Month 1-2**: ₦150,000 - ₦400,000
- 200-500 expert profiles
- Basic premium listings
- Google AdSense integration

**Month 3-4**: ₦400,000 - ₦800,000
- 500+ experts
- Premium listings launch
- Better ad placement optimization

## 📱 Features Ready to Use

✅ **Google Places API Integration** - Real business data
✅ **Cloudinary Image Processing** - No PHP EXIF needed
✅ **Shared Hosting Optimized** - Small batches, memory management
✅ **SEO-Friendly URLs** - Like construction.co.uk
✅ **Mobile Responsive** - Bootstrap 5 design
✅ **Admin Dashboard** - Easy expert management
✅ **Search & Filter** - By category, location, name

## 🔧 Admin Access

Visit: https://findexpert.com.ng/admin
- Dashboard with statistics
- Scraping interface for Google Places
- Expert management

## 💡 Next Steps After Launch

1. **SEO Optimization** - Add meta tags, sitemaps
2. **Premium Features** - Payment integration for featured listings
3. **Email Marketing** - Newsletter for construction professionals
4. **Mobile App** - Progressive Web App features
5. **Analytics** - Google Analytics integration

Your shared hosting can definitely handle this! The optimizations ensure smooth performance even with limited resources.
