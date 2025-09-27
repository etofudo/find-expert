@extends('layouts.app')

@section('title', 'Scrape Experts - Admin')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Scrape Experts</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Google Places API Scraping</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.scrape.run') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Search Terms (one per line)</label>
                            <textarea name="search_terms" class="form-control" rows="5" placeholder="builders Lagos
electricians Lagos
plumbers Lagos
architects Lagos
roofers Lagos">builders Lagos
electricians Lagos
plumbers Lagos
architects Lagos
roofers Lagos</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <select name="location" class="form-select">
                                <option value="Lagos, Nigeria">Lagos, Nigeria</option>
                                <option value="Abuja, Nigeria">Abuja, Nigeria</option>
                                <option value="Port Harcourt, Nigeria">Port Harcourt, Nigeria</option>
                                <option value="Kano, Nigeria">Kano, Nigeria</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Limit per search term</label>
                            <input type="number" name="limit" class="form-control" value="5" min="1" max="20">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-play me-2"></i>Start Scraping
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Scraping Status</h5>
                </div>
                <div class="card-body">
                    @if(session('results'))
                        <div class="alert alert-info">
                            <h6>Last Scraping Results:</h6>
                            <ul class="mb-0">
                                @foreach(session('results') as $result)
                                    <li>{{ $result }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-muted">No recent scraping results.</p>
                    @endif
                </div>
            </div>
            
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Important Notes</h5>
                </div>
                <div class="card-body">
                    <ul class="small">
                        <li>Google Places API key required</li>
                        <li>Small batches for shared hosting</li>
                        <li>Images automatically uploaded to Cloudinary</li>
                        <li>Duplicates are automatically skipped</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
