<?php
namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Category;
use App\Models\State;
use App\Services\OptimizedScrapingService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_experts' => Expert::count(),
            'active_experts' => Expert::where('status', 'active')->count(),
            'premium_experts' => Expert::where('is_premium', true)->count(),
            'pending_experts' => Expert::where('status', 'pending')->count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
    
    public function scrapeForm()
    {
        $categories = Category::all();
        $states = State::all();
        
        return view('admin.scrape', compact('categories', 'states'));
    }
    
    public function runScraping(Request $request)
    {
        $scraper = new OptimizedScrapingService();
        
        // Get search terms from form or use defaults
        $searchTermsText = $request->input('search_terms', 'builders Lagos
electricians Lagos
plumbers Lagos
architects Lagos
construction companies Lagos');
        
        $searchTerms = array_filter(array_map('trim', explode("\n", $searchTermsText)));
        $location = $request->input('location', 'Lagos, Nigeria');
        $limit = (int) $request->input('limit', 5);
        
        $results = [];
        
        foreach ($searchTerms as $term) {
            $experts = $scraper->scrapeGoogleMyBusinessBatch($term, $location, $limit);
            
            foreach ($experts as $expertData) {
                try {
                    $expert = Expert::create($expertData);
                    $results[] = "Created: " . $expert->name;
                } catch (\Exception $e) {
                    $results[] = "Failed: " . $expertData['name'] . " - " . $e->getMessage();
                }
            }
            
            // Small delay for shared hosting
            sleep(2);
        }
        
        return back()->with('results', $results);
    }
}