@extends('layouts.app')

@section('title', 'FindExpert - Nigerian Construction Directory')
@section('description', 'Find professional construction experts, builders, electricians, plumbers and more across Nigeria.')

@section('content')
<!-- Hero Section with Integrated Search -->
<section class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Find Construction Experts in Nigeria</h1>
                <p class="lead mb-4">Connect with verified builders, electricians, plumbers, architects and construction professionals across Nigeria.</p>
                
                <!-- Compact Search Form -->
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card shadow-sm">
                            <div class="card-body p-3">
                                <form action="{{ route('experts.index') }}" method="GET">
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <select name="category" class="form-select form-select-sm">
                                                <option value="">All Categories</option>
                                                <option value="builders" {{ request('category') == 'builders' ? 'selected' : '' }}>Builders</option>
                                                <option value="electrical-contractors" {{ request('category') == 'electrical-contractors' ? 'selected' : '' }}>Electrical Contractors</option>
                                                <option value="plumbers" {{ request('category') == 'plumbers' ? 'selected' : '' }}>Plumbers</option>
                                                <option value="architects" {{ request('category') == 'architects' ? 'selected' : '' }}>Architects</option>
                                                <option value="roofing-contractors" {{ request('category') == 'roofing-contractors' ? 'selected' : '' }}>Roofing Contractors</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select name="state" class="form-select form-select-sm">
                                                <option value="">All States</option>
                                                <option value="lagos" {{ request('state') == 'lagos' ? 'selected' : '' }}>Lagos</option>
                                                <option value="abuja" {{ request('state') == 'abuja' ? 'selected' : '' }}>Abuja</option>
                                                <option value="rivers" {{ request('state') == 'rivers' ? 'selected' : '' }}>Rivers</option>
                                                <option value="kano" {{ request('state') == 'kano' ? 'selected' : '' }}>Kano</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-warning btn-sm w-100">
                                                <i class="fas fa-search me-1"></i>Search Experts
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="text-center">
                    <i class="fas fa-tools" style="font-size: 6rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-4">
    <div class="container">
        <h2 class="text-center mb-4">Popular Categories</h2>
        <div class="row g-3">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'builders']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-hammer text-primary mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Builders</h6>
                            <small class="text-muted">Construction</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'hardware-suppliers']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-warehouse text-success mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Suppliers</h6>
                            <small class="text-muted">Hardware</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'electrical-contractors']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-bolt text-warning mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Electrical</h6>
                            <small class="text-muted">Contractors</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'plumbers']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-wrench text-info mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Plumbers</h6>
                            <small class="text-muted">Plumbing</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'architects']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-drafting-compass text-success mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Architects</h6>
                            <small class="text-muted">Design</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'roofing-contractors']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-home text-danger mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Roofing</h6>
                            <small class="text-muted">Contractors</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'painters-and-decorators']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-paint-brush text-purple mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Painters</h6>
                            <small class="text-muted">Decorators</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'tiling-contractors']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-th text-secondary mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Tiling</h6>
                            <small class="text-muted">Contractors</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'steel-fabricators']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-cog text-dark mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Steel</h6>
                            <small class="text-muted">Fabricators</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'builders-merchants']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-store text-primary mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Merchants</h6>
                            <small class="text-muted">Builders</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'property-maintenance']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-tools text-info mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">Property</h6>
                            <small class="text-muted">Maintenance</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="{{ route('experts.index', ['category' => 'general-contractors']) }}" class="text-decoration-none">
                    <div class="card expert-card h-100 text-center">
                        <div class="card-body p-3">
                            <i class="fas fa-tools text-warning mb-2" style="font-size: 2rem;"></i>
                            <h6 class="mb-1">General</h6>
                            <small class="text-muted">Contractors</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose FindExpert Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Why Choose FindExpert?</h2>
                <p class="text-center text-muted mb-5">Nigeria's most trusted construction directory with verified professionals and comprehensive services</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-shield-alt text-primary mb-3" style="font-size: 3rem;"></i>
                    <h5>Verified Professionals</h5>
                    <p class="text-muted">Every expert is thoroughly vetted and verified for quality, licensing, and reliability. We ensure you work with legitimate, qualified professionals.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-star text-warning mb-3" style="font-size: 3rem;"></i>
                    <h5>Quality Guaranteed</h5>
                    <p class="text-muted">Our experts are rated by real customers. We only feature professionals with proven track records and positive reviews from satisfied clients.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-success mb-3" style="font-size: 3rem;"></i>
                    <h5>Nationwide Coverage</h5>
                    <p class="text-muted">From Lagos to Abuja, Port Harcourt to Kano - find construction experts in every major city across Nigeria. Local knowledge, national reach.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Experts Section -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-3">Featured Construction Experts</h2>
                <p class="text-center text-muted mb-4">Discover top-rated professionals ready to help with your project</p>
            </div>
        </div>
        
        <!-- Horizontal Ad Before Featured Experts -->
        @if(config('adsense.display.show_on_homepage'))
        <div class="row mb-4">
            <div class="col-12">
                <x-adsense slot="horizontal" class="adsense-horizontal" />
            </div>
        </div>
        @endif
        
        <div class="row listing-layout">
            <!-- Main Content -->
            <div class="col-lg-8">
                <div class="row g-4">
                    @forelse($featured_experts as $expert)
                    <div class="col-lg-6 col-md-6">
                        <div class="card expert-card h-100">
                            @if($expert->profile_image)
                                <img src="{{ $expert->profile_image }}" class="card-img-top" alt="{{ $expert->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-user fa-4x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $expert->name }}</h5>
                                <p class="text-muted">{{ $expert->category->name ?? 'General Contractor' }}</p>
                                <p class="card-text small">{{ Str::limit($expert->description, 100) }}</p>
                                
                                @if($expert->rating > 0)
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $expert->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        <small class="text-muted">({{ $expert->total_reviews }} reviews)</small>
                                    </div>
                                @endif
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $expert->state->name ?? 'Lagos' }}
                                    </small>
                                    <a href="{{ route('experts.show', $expert) }}" class="btn btn-primary btn-sm">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4>No experts available</h4>
                            <p class="text-muted">Check back later for new listings.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="{{ route('experts.index') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-list me-2"></i>View All Experts
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Vertical Ad -->
                @if(config('adsense.display.show_on_homepage'))
                <div class="adsense-container adsense-vertical">
                    <x-adsense slot="vertical" class="adsense-vertical" />
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Construction Guide Section -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mb-4">Complete Construction Guide for Nigerian Projects</h2>
                <p class="text-center text-muted mb-5">Everything you need to know about construction projects in Nigeria</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-home text-primary me-2"></i>
                            Building Your Dream Home in Nigeria
                        </h5>
                        <p class="card-text">Planning to build a house in Nigeria? Our comprehensive guide covers everything from land acquisition and permits to choosing the right contractors and materials. Learn about local building codes, cost estimates, and timeline expectations for residential construction projects across different Nigerian states.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Land acquisition and documentation</li>
                            <li><i class="fas fa-check text-success me-2"></i>Building permits and approvals</li>
                            <li><i class="fas fa-check text-success me-2"></i>Cost planning and budgeting</li>
                            <li><i class="fas fa-check text-success me-2"></i>Material selection and sourcing</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-tools text-warning me-2"></i>
                            Renovation and Maintenance Tips
                        </h5>
                        <p class="card-text">Keep your property in top condition with our expert renovation and maintenance advice. From electrical upgrades to plumbing repairs, learn how to identify quality contractors and avoid common pitfalls in Nigerian construction projects.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Electrical system upgrades</li>
                            <li><i class="fas fa-check text-success me-2"></i>Plumbing and water systems</li>
                            <li><i class="fas fa-check text-success me-2"></i>Roofing and waterproofing</li>
                            <li><i class="fas fa-check text-success me-2"></i>Interior design and finishing</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-4 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3">
                <h3 class="fw-bold">{{ $stats['total_experts'] }}+</h3>
                <p>Verified Experts</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">{{ $stats['total_states'] }}+</h3>
                <p>States Covered</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">{{ $stats['total_categories'] }}+</h3>
                <p>Service Categories</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">100%</h3>
                <p>Verified Professionals</p>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
// Pre-populate search form when category is clicked
document.addEventListener('DOMContentLoaded', function() {
    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
    const state = urlParams.get('state');
    
    // Pre-populate form if parameters exist
    if (category) {
        const categorySelect = document.querySelector('select[name="category"]');
        if (categorySelect) {
            categorySelect.value = category;
        }
    }
    
    if (state) {
        const stateSelect = document.querySelector('select[name="state"]');
        if (stateSelect) {
            stateSelect.value = state;
        }
    }
});
</script>
@endsection
