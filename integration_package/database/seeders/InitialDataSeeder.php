<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\Category;
use App\Models\Lga;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Seed Nigerian States
        $states = [
            'Lagos', 'Abuja', 'Rivers', 'Kano', 'Oyo', 'Kaduna', 'Edo', 'Delta',
            'Ogun', 'Imo', 'Anambra', 'Plateau', 'Cross River', 'Akwa Ibom',
            'Enugu', 'Benue', 'Sokoto', 'Bauchi', 'Zamfara', 'Kebbi'
        ];
        
        foreach ($states as $state) {
            State::firstOrCreate(['name' => $state], ['slug' => Str::slug($state)]);
        }
        
        // Seed Categories
        $categories = [
            'Builders', 'Electrical Contractors', 'Plumbers', 'Architects',
            'Roofing Contractors', 'Painters and Decorators', 'Tiling Contractors',
            'Steel Fabricators', 'Builders Merchants', 'Equipment Hire',
            'Civil Engineers', 'Quantity Surveyors', 'Property Maintenance',
            'Hardware Suppliers', 'General Contractors'
        ];
        
        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category], ['slug' => Str::slug($category)]);
        }
        
        // Seed Lagos LGAs
        $lagosState = State::where('name', 'Lagos')->first();
        if ($lagosState) {
            $lagosLGAs = [
                'Ikeja', 'Victoria Island', 'Lekki', 'Surulere', 'Yaba',
                'Ikoyi', 'Apapa', 'Lagos Island', 'Lagos Mainland', 'Mushin',
                'Oshodi', 'Agege', 'Alimosho', 'Amuwo-Odofin', 'Badagry',
                'Epe', 'Eti-Osa', 'Ibeju-Lekki', 'Ifako-Ijaiye', 'Ikorodu'
            ];
            
            foreach ($lagosLGAs as $lga) {
                Lga::firstOrCreate([
                    'name' => $lga,
                    'state_id' => $lagosState->id
                ]);
            }
        }
    }
}
