<?php
namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Category;
use App\Models\State;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function index(Request $request)
    {
        $query = Expert::with(['category', 'state', 'lga'])
                      ->where('status', 'active');
        
        // Filter by category
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        
        // Filter by state
        if ($request->filled('state')) {
            $query->whereHas('state', function($q) use ($request) {
                $q->where('slug', $request->state);
            });
        }
        
        // Search by name or description
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        $experts = $query->paginate(12);
        $categories = Category::all();
        $states = State::all();
        
        return view('experts.index', compact('experts', 'categories', 'states'));
    }
    
    public function show(Expert $expert)
    {
        $expert->load(['category', 'state', 'lga', 'galleries']);
        
        return view('experts.show', compact('expert'));
    }
}