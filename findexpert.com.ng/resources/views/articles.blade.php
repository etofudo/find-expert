@extends('layouts.app')

@section('title', 'Construction Articles & Guides - FindExpert')
@section('description', 'Expert construction advice, guides, and tips for Nigerian homeowners and businesses. Learn about building, renovation, and maintenance.')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-5">Construction Articles & Guides</h1>
            <p class="text-center text-muted mb-5">Expert advice and practical tips for your construction projects in Nigeria</p>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Featured Article -->
        <div class="col-12">
            <div class="card featured-article">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                             class="card-img-top" alt="Construction site in Nigeria" style="height: 250px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">Complete Guide to Building a House in Nigeria</h2>
                            <p class="card-text">Everything you need to know about building your dream home in Nigeria, from land acquisition to final inspection. This comprehensive guide covers costs, permits, materials, and timeline expectations for residential construction projects across different Nigerian states.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">Published: December 2024</small>
                                <a href="{{ route('articles.building-guide') }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Article Grid -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     class="card-img-top" alt="Electrical work in Nigerian home" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Electrical Safety in Nigerian Homes</h5>
                    <p class="card-text">Essential electrical safety tips for Nigerian homeowners. Learn about proper wiring, surge protection, and how to choose qualified electricians for your projects.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">5 min read</small>
                        <a href="{{ route('articles.electrical-safety') }}" class="btn btn-outline-primary btn-sm">Read</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     class="card-img-top" alt="Plumbing work in Nigeria" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Plumbing Maintenance Checklist</h5>
                    <p class="card-text">Keep your plumbing system in top condition with this comprehensive maintenance checklist. Prevent costly repairs and ensure reliable water supply.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">4 min read</small>
                        <a href="{{ route('articles.plumbing-maintenance') }}" class="btn btn-outline-primary btn-sm">Read</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     class="card-img-top" alt="Architect working on plans" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Choosing the Right Architect</h5>
                    <p class="card-text">What to look for when hiring an architect in Nigeria. Questions to ask, portfolio evaluation, and understanding architectural fees and contracts.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">6 min read</small>
                        <a href="{{ route('articles.choosing-architect') }}" class="btn btn-outline-primary btn-sm">Read</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     class="card-img-top" alt="Roofing work in Nigeria" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Roofing Materials for Nigerian Climate</h5>
                    <p class="card-text">Best roofing materials for Nigeria's tropical climate. Compare aluminum, zinc, and other options for durability and cost-effectiveness.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">5 min read</small>
                        <a href="{{ route('articles.roofing-materials') }}" class="btn btn-outline-primary btn-sm">Read</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     class="card-img-top" alt="Modern interior design" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Interior Design Trends 2024</h5>
                    <p class="card-text">Latest interior design trends for Nigerian homes. Color schemes, furniture choices, and space optimization ideas for modern living.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">4 min read</small>
                        <a href="{{ route('articles.interior-design-trends') }}" class="btn btn-outline-primary btn-sm">Read</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     class="card-img-top" alt="Construction cost planning" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">Construction Cost Estimation</h5>
                    <p class="card-text">How to accurately estimate construction costs in Nigeria. Material prices, labor costs, and hidden expenses to consider for your budget.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">7 min read</small>
                        <a href="{{ route('articles.construction-costs') }}" class="btn btn-outline-primary btn-sm">Read</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Construction Tips Section -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-center mb-4">Quick Construction Tips</h2>
        </div>
    </div>
    
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-lightbulb text-warning me-2"></i>
                        Before You Start Building
                    </h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Verify land ownership and obtain necessary permits</li>
                        <li><i class="fas fa-check text-success me-2"></i>Conduct soil tests to determine foundation requirements</li>
                        <li><i class="fas fa-check text-success me-2"></i>Set a realistic budget with 20% contingency for unexpected costs</li>
                        <li><i class="fas fa-check text-success me-2"></i>Choose experienced contractors with proven track records</li>
                        <li><i class="fas fa-check text-success me-2"></i>Plan for adequate water and electricity connections</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-shield-alt text-primary me-2"></i>
                        Safety First
                    </h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Always hire licensed and insured professionals</li>
                        <li><i class="fas fa-check text-success me-2"></i>Ensure proper electrical grounding and surge protection</li>
                        <li><i class="fas fa-check text-success me-2"></i>Install smoke detectors and fire safety equipment</li>
                        <li><i class="fas fa-check text-success me-2"></i>Use quality materials that meet Nigerian standards</li>
                        <li><i class="fas fa-check text-success me-2"></i>Regular maintenance prevents costly repairs later</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Call to Action -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h3 class="card-title">Need Professional Help?</h3>
                    <p class="card-text">Ready to start your construction project? Find verified professionals in your area.</p>
                    <a href="{{ route('experts.index') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-search me-2"></i>Find Your Expert
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
