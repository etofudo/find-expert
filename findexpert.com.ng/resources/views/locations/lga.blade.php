@extends('layouts.app')

@section('title', $lga->name . ', ' . $state->name . ' Construction Experts - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Construction Experts in {{ $lga->name }}, {{ $state->name }}</h1>
            <p class="lead">Find professional construction experts, builders, electricians, plumbers and more in {{ $lga->name }}, {{ $state->name }}, Nigeria.</p>
        </div>
    </div>

    <!-- Experts Grid -->
    <div class="row g-4">
        @forelse($experts as $expert)
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
                    <h4>No experts found in {{ $lga->name }}, {{ $state->name }}</h4>
                    <p class="text-muted">Check back later or browse other locations.</p>
                </div>
            </div>
        @endforelse
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
