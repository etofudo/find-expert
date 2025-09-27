<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lga extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'state_id'];
    
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    
    public function experts()
    {
        return $this->hasMany(Expert::class);
    }
}