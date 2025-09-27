<?php
namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Lga;
use App\Models\Expert;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function state(State $state)
    {
        $experts = Expert::where('state_id', $state->id)
                        ->where('status', 'active')
                        ->paginate(12);
        
        return view('locations.state', compact('state', 'experts'));
    }
    
    public function lga(State $state, Lga $lga)
    {
        $experts = Expert::where('state_id', $state->id)
                        ->where('lga_id', $lga->id)
                        ->where('status', 'active')
                        ->paginate(12);
        
        return view('locations.lga', compact('state', 'lga', 'experts'));
    }
}
