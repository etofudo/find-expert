@extends('layouts.app')

@section('title', $expert->name . ' - FindExpert')
@section('description', 'Contact ' . $expert->name . ' - ' . ($expert->category->name ?? 'Construction Professional') . ' in ' . ($expert->state->name ?? 'Nigeria') . '. ' . Str::limit($expert->description, 150))

@section('content')
<div class="container py-5">
    <!-- Horizontal Ad Before Profile -->
    @if(config('adsense.display.show_on_profiles'))
    <div class="row mb-4">
        <div class="col-12">
            <x-adsense slot="horizontal" class="adsense-horizontal" />
        </div>
    </div>
    @endif
    
    <div class="row listing-layout">
        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Profile Header -->
            <div class="card mb-4">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if($expert->profile_image)
                            <img src="{{ $expert->profile_image }}" class="img-fluid rounded-start" alt="{{ $expert->name }}" style="height: 250px; object-fit: cover; width: 100%;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded-start" style="height: 250px;">
                                <i class="fas fa-user fa-4x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="card-title mb-1">{{ $expert->name }}</h2>
                                    <p class="text-muted mb-2">{{ $expert->category->name ?? 'General Contractor' }}</p>
                                    <p class="text-muted small">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        {{ $expert->state->name ?? 'Lagos' }}{{ $expert->lga ? ', ' . $expert->lga->name : '' }}
                                    </p>
                                </div>
                                <a href="{{ route('experts.edit', $expert) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                            </div>
                            
                            @if($expert->rating > 0)
                                <div class="mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $expert->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                    <span class="ms-2">{{ $expert->rating }}/5 ({{ $expert->total_reviews }} reviews)</span>
                                </div>
                            @endif

                            <div class="d-grid gap-2 d-md-flex">
                                @if($expert->phone)
                                    <a href="tel:{{ $expert->phone }}" class="btn btn-primary">
                                        <i class="fas fa-phone me-2"></i>Call Now
                                    </a>
                                @endif
                                @if($expert->email)
                                    <a href="mailto:{{ $expert->email }}" class="btn btn-outline-primary">
                                        <i class="fas fa-envelope me-2"></i>Send Email
                                    </a>
                                @endif
                                @if($expert->whatsapp)
                                    <a href="https://wa.me/{{ $expert->whatsapp }}" class="btn btn-success" target="_blank">
                                        <i class="fab fa-whatsapp me-2"></i>WhatsApp
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">About {{ $expert->name }}</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $expert->description }}</p>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6>Service Category</h6>
                            <span class="badge bg-primary">{{ $expert->category->name ?? 'General Contractor' }}</span>
                        </div>
                        <div class="col-md-6">
                            <h6>Status</h6>
                            <span class="badge bg-{{ $expert->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($expert->status) }}
                            </span>
                        </div>
                    </div>

                    @if($expert->data_source)
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Data source: {{ ucfirst(str_replace('_', ' ', $expert->data_source)) }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Gallery -->
            @if($expert->galleries->count() > 0)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Project Gallery</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($expert->galleries as $gallery)
                                <div class="col-md-4">
                                    <img src="{{ $gallery->image_url }}" class="img-fluid rounded" alt="Project image" style="height: 200px; object-fit: cover; width: 100%;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Contact Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Contact Information</h6>
                </div>
                <div class="card-body">
                    @if($expert->phone)
                    <p class="mb-3">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <a href="tel:{{ $expert->phone }}" class="text-decoration-none">{{ $expert->phone }}</a>
                    </p>
                    @endif
                    
                    @if($expert->whatsapp)
                    <p class="mb-3">
                        <i class="fab fa-whatsapp me-2 text-success"></i>
                        <a href="https://wa.me/{{ $expert->whatsapp }}" class="text-decoration-none" target="_blank">WhatsApp</a>
                    </p>
                    @endif
                    
                    @if($expert->email)
                    <p class="mb-3">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <a href="mailto:{{ $expert->email }}" class="text-decoration-none">{{ $expert->email }}</a>
                    </p>
                    @endif
                    
                    @if($expert->website)
                    <p class="mb-3">
                        <i class="fas fa-globe me-2 text-primary"></i>
                        <a href="{{ $expert->website }}" class="text-decoration-none" target="_blank">Visit Website</a>
                    </p>
                    @endif

                    @if($expert->address)
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        {{ $expert->address }}
                    </p>
                    @endif
                </div>
            </div>

            <!-- Vertical Ad -->
            @if(config('adsense.display.show_on_profiles'))
            <div class="adsense-container adsense-vertical">
                <x-adsense slot="vertical" class="adsense-vertical" />
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
