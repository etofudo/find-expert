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
        
        // Get featured experts (top-rated or recent)
        $featured_experts = Expert::with(['category', 'state'])
            ->where('status', 'active')
            ->orderBy('rating', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        return view('home', compact('stats', 'featured_experts'));
    }
}