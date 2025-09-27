<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'code'];
    
    public function lgas()
    {
        return $this->hasMany(Lga::class);
    }
    
    public function experts()
    {
        return $this->hasMany(Expert::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}