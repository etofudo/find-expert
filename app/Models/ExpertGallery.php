<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertGallery extends Model
{
    use HasFactory;
    
    protected $fillable = ['expert_id', 'image_url', 'title', 'description', 'sort_order'];
    
    public function expert()
    {
        return $this->belongsTo(Expert::class);
    }
}