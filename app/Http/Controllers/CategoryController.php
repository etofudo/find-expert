<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expert;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $experts = Expert::where('category_id', $category->id)
                        ->where('status', 'active')
                        ->paginate(12);
        
        return view('categories.show', compact('category', 'experts'));
    }
}
