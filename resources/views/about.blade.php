@extends('layouts.app')

@section('title', 'About Us - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">About FindExpert</h1>
            <p class="lead text-muted">Nigeria's premier construction directory connecting you with verified professionals across the country.</p>
            
            <!-- Mission Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Our Mission</h2>
                    <p class="card-text">FindExpert was created to solve a critical problem in Nigeria's construction industry: the difficulty of finding reliable, qualified, and trustworthy construction professionals. We believe that every construction project, whether it's building a home, renovating an office, or completing a commercial development, deserves access to the best professionals in the field.</p>
                    
                    <p>Our platform serves as a bridge between property owners, project managers, and construction experts, making it easier than ever to connect with the right professionals for any construction need.</p>
                </div>
            </div>
            
            <!-- What We Do -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">What We Do</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-search me-2 text-primary"></i>Expert Discovery</h5>
                            <p>We maintain a comprehensive directory of verified construction professionals across Nigeria, including contractors, electricians, plumbers, architects, and more.</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-shield-alt me-2 text-primary"></i>Quality Assurance</h5>
                            <p>Every expert in our directory is carefully vetted to ensure they meet our quality standards and have the necessary credentials for their field.</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-map-marker-alt me-2 text-primary"></i>Location-Based Search</h5>
                            <p>Find professionals in your specific area, whether you're in Lagos, Abuja, Kano, or any other state in Nigeria.</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-star me-2 text-primary"></i>Reviews & Ratings</h5>
                            <p>Read reviews from previous clients and see ratings to help you make informed decisions about which professional to hire.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Our Story -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Our Story</h2>
                    <p>FindExpert was born out of personal experience. After struggling to find reliable construction professionals for various projects, we realized that many Nigerians face the same challenge. The construction industry in Nigeria is vast and diverse, but finding the right professional for your specific needs can be overwhelming and time-consuming.</p>
                    
                    <p>We set out to create a solution that would:</p>
                    <ul>
                        <li>Centralize information about construction professionals in one easy-to-use platform</li>
                        <li>Provide detailed profiles with contact information, services, and client reviews</li>
                        <li>Make it easy to search and filter professionals by location, specialty, and other criteria</li>
                        <li>Ensure quality by vetting professionals before they join our platform</li>
                    </ul>
                    
                    <p>Today, FindExpert has grown into Nigeria's most trusted construction directory, helping thousands of people find the right professionals for their projects.</p>
                </div>
            </div>
            
            <!-- Our Values -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">Our Values</h2>
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <i class="fas fa-handshake fa-3x text-primary mb-3"></i>
                            <h5>Trust</h5>
                            <p>We believe in building trust through transparency, quality assurance, and honest reviews.</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h5>Community</h5>
                            <p>We foster a community where professionals and clients can connect and grow together.</p>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <i class="fas fa-award fa-3x text-primary mb-3"></i>
                            <h5>Excellence</h5>
                            <p>We strive for excellence in everything we do, from our platform to our service quality.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">FindExpert by the Numbers</h2>
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <h3 class="text-primary">500+</h3>
                            <p class="text-muted">Verified Professionals</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <h3 class="text-primary">36</h3>
                            <p class="text-muted">States Covered</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <h3 class="text-primary">50+</h3>
                            <p class="text-muted">Service Categories</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <h3 class="text-primary">1000+</h3>
                            <p class="text-muted">Successful Projects</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Call to Action -->
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <h3 class="card-title">Ready to Find Your Expert?</h3>
                    <p class="card-text">Join thousands of satisfied customers who have found their perfect construction professional through FindExpert.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('experts.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-search me-2"></i>Browse Experts
                        </a>
                        <a href="{{ route('experts.register') }}" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Register Your Business
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
