<?php
namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Category;
use App\Models\State;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_experts' => Expert::count(),
            'total_states' => State::count(),
            'total_categories' => Category::count(),
        ];
        
        return view('home', compact('stats'));
    }
}