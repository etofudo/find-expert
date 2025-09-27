@extends('layouts.app')

@section('title', 'Admin Dashboard - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Admin Dashboard</h1>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $stats['total_experts'] }}</h4>
                            <p class="mb-0">Total Experts</p>
                        </div>
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $stats['active_experts'] }}</h4>
                            <p class="mb-0">Active Experts</p>
                        </div>
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $stats['premium_experts'] }}</h4>
                            <p class="mb-0">Premium Experts</p>
                        </div>
                        <i class="fas fa-star fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>{{ $stats['inactive_experts'] }}</h4>
                            <p class="mb-0">Inactive Experts</p>
                        </div>
                        <i class="fas fa-ban fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.scrape') }}" class="btn btn-primary">
                            <i class="fas fa-download me-2"></i>Scrape New Experts
                        </a>
                        <a href="{{ route('admin.manage') }}" class="btn btn-outline-warning">
                            <i class="fas fa-users-cog me-2"></i>Manage Experts
                        </a>
                        <a href="{{ route('experts.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-list me-2"></i>View All Experts
                        </a>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-eye me-2"></i>View Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Recent Activity</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">No recent activity to display.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
