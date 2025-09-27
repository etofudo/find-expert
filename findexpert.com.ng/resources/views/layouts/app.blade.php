<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FindExpert - Nigerian Construction Directory')</title>
    <meta name="description" content="@yield('description', 'Find professional construction experts, builders, electricians, plumbers and more across Nigeria.')">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google AdSense Verification Code -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6565143029743718" crossorigin="anonymous"></script>
    
    @if(config('adsense.enabled') && config('adsense.publisher_id'))
    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-{{ config('adsense.publisher_id') }}" crossorigin="anonymous"></script>
    @endif
    
    <style>
        .hero-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .expert-card { transition: transform 0.3s; }
        .expert-card:hover { transform: translateY(-5px); }
        .adsense-container { margin: 20px 0; text-align: center; }
        .adsense-container.adsense-header { margin: 10px 0; }
        .adsense-container.adsense-sidebar { margin: 0 0 20px 0; }
        .adsense-container.adsense-horizontal { 
            margin: 0 0 20px 0; 
            text-align: center;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
        }
        .adsense-container.adsense-vertical { 
            margin: 0 0 20px 0; 
            text-align: center;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
        }
        
        /* Add more spacing for premium feel */
        main { margin-bottom: 4rem; }
        .container.py-5 { padding-top: 4rem !important; padding-bottom: 4rem !important; }
        
        /* Desktop tweaks for card proportions */
        @media (min-width: 992px) {
            .expert-card .card-img-top { height: 160px !important; object-fit: cover; }
            .expert-card .card-title { margin-bottom: 0.35rem; }
            .expert-card .card-text.small { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 2.6em; }
            /* tighter grid spacing on desktop */
            .row.g-4 { --bs-gutter-x: 1rem; --bs-gutter-y: 1.25rem; }
            /* match gutter between listing and sidebar to card gutter */
            .row.listing-layout { --bs-gutter-x: 1rem; }
        }
        
        /* Fix button hover visibility */
        .btn-outline-light:hover {
            color: #fff !important;
            background-color: #007bff !important;
            border-color: #007bff !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-hammer me-2"></i>FindExpert
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('experts.index') }}">All Experts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles') }}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm me-2" href="{{ route('experts.register') }}" style="color: white !important; border-color: white !important;">
                            <i class="fas fa-user-plus me-1"></i>Register your Business
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Header Ad -->
        @if(config('adsense.display.show_on_homepage') || config('adsense.display.show_on_listings') || config('adsense.display.show_on_profiles'))
        <div class="container">
            <x-adsense slot="header" class="adsense-header" />
        </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer Ad -->
    @if(config('adsense.display.show_on_homepage') || config('adsense.display.show_on_listings') || config('adsense.display.show_on_profiles'))
    <div class="container">
        <x-adsense slot="footer" class="adsense-footer" />
    </div>
    @endif

    <!-- Footer -->
    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>FindExpert</h5>
                    <p>Nigeria's premier construction directory connecting you with verified professionals.</p>
                </div>
                <div class="col-md-4">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="text-light text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-light text-decoration-none">Contact</a></li>
                        <li><a href="{{ route('experts.register') }}" class="text-light text-decoration-none">Register Business</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Legal</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('privacy') }}" class="text-light text-decoration-none">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="text-light text-decoration-none">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-3">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; {{ date('Y') }} FindExpert. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
