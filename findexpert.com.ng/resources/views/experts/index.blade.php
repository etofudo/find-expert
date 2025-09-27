@extends('layouts.app')

@section('title', 'Construction Experts - FindExpert')
@section('description', 'Browse our directory of verified construction professionals in Nigeria. Find contractors, electricians, plumbers, architects, and more in your area.')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Construction Experts</h1>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('experts.index') }}">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State</label>
                                <select name="state" class="form-select">
                                    <option value="">All States</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->slug }}" {{ request('state') == $state->slug ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Search</label>
                                <input type="text" name="search" class="form-control" placeholder="Search experts..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('experts.index') }}" class="btn btn-outline-secondary">Clear</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Horizontal Ad Before Listings -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="adsense-container adsense-horizontal" style="min-height: 90px; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; text-align: center;">
                <p class="text-muted mb-0">📢 Ad Space - Horizontal Banner (728x90)</p>
                <small class="text-muted">This will show your AdSense ads when configured</small>
            </div>
        </div>
    </div>

    <!-- Main Content with Sidebar -->
    <div class="row listing-layout">
        <!-- Experts Grid -->
        <div class="col-lg-9">
            <div class="row g-4">
                @forelse($experts as $index => $expert)
                    @if($index > 0 && $index % 6 == 0)
                        <!-- Ad between listings every 6 cards -->
                        <div class="col-12 mb-4">
                            <div class="adsense-container adsense-horizontal" style="min-height: 90px; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; text-align: center;">
                                <p class="text-muted mb-0">📢 Ad Space - Horizontal Banner (728x90)</p>
                                <small class="text-muted">This will show your AdSense ads when configured</small>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6 col-lg-4">
                        <div class="card expert-card h-100">
                            @if($expert->profile_image)
                                <img src="{{ $expert->profile_image }}" class="card-img-top" alt="{{ $expert->name }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $expert->name }}</h5>
                                <p class="card-text text-muted">{{ $expert->category->name ?? 'General Contractor' }}</p>
                                <p class="card-text small">{{ strlen($expert->description) > 100 ? substr($expert->description, 0, 100) . '...' : $expert->description }}</p>
                                @if($expert->rating > 0)
                                    <div class="mb-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $expert->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                        <small class="text-muted">({{ $expert->total_reviews }} reviews)</small>
                                    </div>
                                @endif
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $expert->state->name ?? 'Lagos' }}</small>
                                    <a href="{{ route('experts.show', $expert) }}" class="btn btn-sm btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4>No experts found</h4>
                            <p class="text-muted">Try adjusting your search criteria or check back later.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-3">
            <!-- Quick Stats -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Quick Stats</h6>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>{{ $experts->total() }}</strong> Total Experts</p>
                    <p class="mb-2"><strong>{{ $categories->count() }}</strong> Categories</p>
                    <p class="mb-0"><strong>{{ $states->count() }}</strong> States Covered</p>
                </div>
            </div>
            
            <!-- Popular Categories -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Popular Categories</h6>
                </div>
                <div class="card-body">
                    @foreach($categories->take(5) as $category)
                    <a href="{{ route('categories.show', $category) }}" class="d-block text-decoration-none mb-2">
                        <i class="fas fa-arrow-right me-2 text-primary"></i>{{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Vertical Ad Below Sidebar -->
            <div class="adsense-container adsense-vertical" style="min-height: 600px; background: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px; text-align: center;">
                <p class="text-muted mb-0">📢 Ad Space - Vertical Banner (300x600)</p>
                <small class="text-muted">This will show your AdSense ads when configured</small>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($experts->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                {{ $experts->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
