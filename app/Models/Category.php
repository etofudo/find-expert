<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'description', 'icon', 'is_active', 'sort_order'];
    
    public function experts()
    {
        return $this->hasMany(Expert::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}