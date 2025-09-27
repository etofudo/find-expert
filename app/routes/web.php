<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages
Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Expert routes
Route::get('/experts', [ExpertController::class, 'index'])->name('experts.index');
Route::get('/expert/{expert}', [ExpertController::class, 'show'])->name('experts.show');

// Expert registration routes
Route::get('/register', [ExpertController::class, 'showRegistrationForm'])->name('experts.register');
Route::post('/register', [ExpertController::class, 'register'])->name('experts.register.store');
Route::get('/expert/{expert}/edit', [ExpertController::class, 'edit'])->name('experts.edit');
Route::put('/expert/{expert}', [ExpertController::class, 'update'])->name('experts.update');

// Category routes (SEO-friendly like construction.co.uk)
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Location routes
Route::get('/location/{state}', [LocationController::class, 'state'])->name('locations.state');
Route::get('/location/{state}/{lga}', [LocationController::class, 'lga'])->name('locations.lga');

// Admin routes (for your management)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/scrape', [AdminController::class, 'scrapeForm'])->name('admin.scrape');
    Route::post('/scrape/run', [AdminController::class, 'runScraping'])->name('admin.scrape.run');
    Route::get('/manage', [AdminController::class, 'manageExperts'])->name('admin.manage');
    Route::post('/expert/{expert}/disapprove', [AdminController::class, 'disapproveExpert'])->name('admin.expert.disapprove');
    Route::post('/expert/{expert}/reactivate', [AdminController::class, 'reactivateExpert'])->name('admin.expert.reactivate');
});