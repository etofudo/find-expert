<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'slug', 'email', 'phone', 'whatsapp', 'website', 'address',
        'state_id', 'lga_id', 'category_id', 'description', 'profile_image',
        'rating', 'total_reviews', 'is_verified', 'is_premium', 'status',
        'data_source', 'google_place_id', 'social_media', 'premium_expires_at'
    ];
    
    protected $casts = [
        'social_media' => 'array',
        'premium_expires_at' => 'datetime',
        'is_verified' => 'boolean',
        'is_premium' => 'boolean'
    ];
    
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function galleries()
    {
        return $this->hasMany(ExpertGallery::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}