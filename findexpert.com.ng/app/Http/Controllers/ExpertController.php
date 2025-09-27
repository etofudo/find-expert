<?php
namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Category;
use App\Models\State;
use App\Models\Lga;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Cloudinary\Api\Upload\UploadApi;

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
    
    public function showRegistrationForm()
    {
        $categories = Category::where('is_active', true)->get();
        $states = State::all();
        
        return view('experts.register', compact('categories', 'states'));
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:experts,email',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'lga_id' => 'nullable|exists:lgas,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:50',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array|max:5',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_media' => 'nullable|array',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.linkedin' => 'nullable|url',
        ]);
        
        $uploadApi = new UploadApi();
        $expertData = $request->only([
            'name', 'email', 'phone', 'whatsapp', 'website', 'address',
            'state_id', 'lga_id', 'category_id', 'description', 'social_media'
        ]);
        
        // Generate slug
        $expertData['slug'] = Str::slug($request->name);
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $uploadApi->upload($request->file('profile_image')->getRealPath(), [
                'folder' => 'findexpert/profiles',
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'fill',
                    'gravity' => 'face'
                ]
            ]);
            $expertData['profile_image'] = $profileImage['secure_url'];
        }
        
        // Set initial status as active (auto-approve)
        $expertData['status'] = 'active';
        $expertData['data_source'] = 'manual';
        
        // Create expert
        $expert = Expert::create($expertData);
        
        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $galleryImage = $uploadApi->upload($image->getRealPath(), [
                    'folder' => 'findexpert/gallery',
                    'transformation' => [
                        'width' => 800,
                        'height' => 600,
                        'crop' => 'fill'
                    ]
                ]);
                
                $expert->galleries()->create([
                    'image_url' => $galleryImage['secure_url'],
                    'title' => 'Gallery Image ' . ($index + 1),
                    'sort_order' => $index + 1
                ]);
            }
        }
        
        return redirect()->route('experts.show', $expert)
                        ->with('success', 'Your business has been registered successfully! Your profile is now live on FindExpert.');
    }
    
    public function edit(Expert $expert)
    {
        $categories = Category::where('is_active', true)->get();
        $states = State::all();
        $lgas = Lga::where('state_id', $expert->state_id)->get();
        
        return view('experts.edit', compact('expert', 'categories', 'states', 'lgas'));
    }
    
    public function update(Request $request, Expert $expert)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:experts,email,' . $expert->id,
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'website' => 'nullable|url',
            'address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'lga_id' => 'nullable|exists:lgas,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string|min:50',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array|max:5',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'social_media' => 'nullable|array',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.linkedin' => 'nullable|url',
        ]);
        
        $uploadApi = new UploadApi();
        $expertData = $request->only([
            'name', 'email', 'phone', 'whatsapp', 'website', 'address',
            'state_id', 'lga_id', 'category_id', 'description', 'social_media'
        ]);
        
        // Update slug if name changed
        if ($expert->name !== $request->name) {
            $expertData['slug'] = Str::slug($request->name);
        }
        
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $uploadApi->upload($request->file('profile_image')->getRealPath(), [
                'folder' => 'findexpert/profiles',
                'transformation' => [
                    'width' => 400,
                    'height' => 400,
                    'crop' => 'fill',
                    'gravity' => 'face'
                ]
            ]);
            $expertData['profile_image'] = $profileImage['secure_url'];
        }
        
        // Update expert
        $expert->update($expertData);
        
        // Handle new gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $galleryImage = $uploadApi->upload($image->getRealPath(), [
                    'folder' => 'findexpert/gallery',
                    'transformation' => [
                        'width' => 800,
                        'height' => 600,
                        'crop' => 'fill'
                    ]
                ]);
                
                $expert->galleries()->create([
                    'image_url' => $galleryImage['secure_url'],
                    'title' => 'Gallery Image ' . ($expert->galleries()->count() + $index + 1),
                    'sort_order' => $expert->galleries()->count() + $index + 1
                ]);
            }
        }
        
        return redirect()->route('experts.show', $expert)
                        ->with('success', 'Your profile has been updated successfully!');
    }
}