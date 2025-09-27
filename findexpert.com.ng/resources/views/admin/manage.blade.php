@extends('layouts.app')

@section('title', 'Manage Experts - Admin')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>
                    <i class="fas fa-users-cog me-2"></i>Manage Active Experts
                </h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($experts->count() > 0)
                <div class="row">
                    @foreach($experts as $expert)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            @if($expert->profile_image)
                                <img src="{{ $expert->profile_image }}" class="card-img-top" alt="{{ $expert->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-user fa-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $expert->name }}</h5>
                                <p class="card-text text-muted">{{ $expert->category->name ?? 'General Contractor' }}</p>
                                
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $expert->state->name ?? 'Unknown' }}
                                        @if($expert->lga)
                                            , {{ $expert->lga->name }}
                                        @endif
                                    </small>
                                </div>
                                
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-envelope me-1"></i>
                                        {{ $expert->email }}
                                    </small>
                                </div>
                                
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-phone me-1"></i>
                                        {{ $expert->phone }}
                                    </small>
                                </div>
                                
                                @if($expert->description)
                                <p class="card-text flex-grow-1">
                                    {{ strlen($expert->description) > 100 ? substr($expert->description, 0, 100) . '...' : $expert->description }}
                                </p>
                                @endif
                                
                                <div class="mt-auto">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('experts.show', $expert) }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                            <i class="fas fa-eye me-1"></i>View Profile
                                        </a>
                                        
                                        <form action="{{ route('admin.expert.disapprove', $expert) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm w-100" 
                                                    onclick="return confirm('Are you sure you want to remove this expert from the directory?')">
                                                <i class="fas fa-ban me-1"></i>Remove from Directory
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i>
                                    Registered: {{ $expert->created_at->format('M d, Y') }}
                                    @if($expert->data_source === 'manual')
                                        <span class="badge bg-info ms-2">Manual Registration</span>
                                    @else
                                        <span class="badge bg-success ms-2">Scraped</span>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $experts->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-users fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">No Active Experts</h4>
                    <p class="text-muted">No experts are currently active in the directory.</p>
                    <a href="{{ route('admin.scrape') }}" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i>Scrape New Experts
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
