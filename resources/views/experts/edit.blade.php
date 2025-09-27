@extends('layouts.app')

@section('title', 'Edit Profile - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Your Profile
                    </h3>
                    <p class="mb-0 mt-2">Update your business information</p>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('experts.update', $expert) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Business Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">Business Information</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Business Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $expert->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $expert->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $expert->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="whatsapp" class="form-label">WhatsApp Number</label>
                                <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror" 
                                       id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $expert->whatsapp) }}">
                                @error('whatsapp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                       id="website" name="website" value="{{ old('website', $expert->website) }}" 
                                       placeholder="https://yourwebsite.com">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Business Category <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $expert->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Location Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mt-4">Location Information</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="state_id" class="form-label">State <span class="text-danger">*</span></label>
                                <select class="form-select @error('state_id') is-invalid @enderror" 
                                        id="state_id" name="state_id" required>
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" 
                                                {{ old('state_id', $expert->state_id) == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="lga_id" class="form-label">Local Government Area</label>
                                <select class="form-select @error('lga_id') is-invalid @enderror" 
                                        id="lga_id" name="lga_id">
                                    <option value="">Select LGA</option>
                                    @foreach($lgas as $lga)
                                        <option value="{{ $lga->id }}" 
                                                {{ old('lga_id', $expert->lga_id) == $lga->id ? 'selected' : '' }}>
                                            {{ $lga->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('lga_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="address" class="form-label">Full Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="2" required>{{ old('address', $expert->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Business Description -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mt-4">Business Description</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="description" class="form-label">Business Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4" required 
                                          placeholder="Tell us about your business, services, experience, and what makes you unique...">{{ old('description', $expert->description) }}</textarea>
                                <div class="form-text">Minimum 50 characters. Be detailed to attract more customers.</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Current Images -->
                        @if($expert->profile_image || $expert->galleries->count() > 0)
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mt-4">Current Images</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            @if($expert->profile_image)
                            <div class="col-md-6">
                                <label class="form-label">Current Profile Image</label>
                                <div class="text-center">
                                    <img src="{{ $expert->profile_image }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            </div>
                            @endif
                            
                            @if($expert->galleries->count() > 0)
                            <div class="col-md-6">
                                <label class="form-label">Current Gallery Images</label>
                                <div class="row">
                                    @foreach($expert->galleries as $gallery)
                                    <div class="col-6 mb-2">
                                        <img src="{{ $gallery->image_url }}" alt="Gallery Image" class="img-thumbnail" style="max-width: 100px;">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif

                        <!-- New Images -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mt-4">Update Images</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="profile_image" class="form-label">New Profile Image</label>
                                <input type="file" class="form-control @error('profile_image') is-invalid @enderror" 
                                       id="profile_image" name="profile_image" accept="image/*">
                                <div class="form-text">Leave empty to keep current image. Recommended: 400x400px, JPG/PNG format</div>
                                @error('profile_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="gallery_images" class="form-label">Additional Gallery Images</label>
                                <input type="file" class="form-control @error('gallery_images') is-invalid @enderror" 
                                       id="gallery_images" name="gallery_images[]" accept="image/*" multiple>
                                <div class="form-text">Add more images to your gallery. Up to 5 additional images.</div>
                                @error('gallery_images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2 mt-4">Social Media</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="social_facebook" class="form-label">Facebook</label>
                                <input type="url" class="form-control @error('social_media.facebook') is-invalid @enderror" 
                                       id="social_facebook" name="social_media[facebook]" 
                                       value="{{ old('social_media.facebook', $expert->social_media['facebook'] ?? '') }}" 
                                       placeholder="https://facebook.com/yourpage">
                                @error('social_media.facebook')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="social_instagram" class="form-label">Instagram</label>
                                <input type="url" class="form-control @error('social_media.instagram') is-invalid @enderror" 
                                       id="social_instagram" name="social_media[instagram]" 
                                       value="{{ old('social_media.instagram', $expert->social_media['instagram'] ?? '') }}" 
                                       placeholder="https://instagram.com/yourpage">
                                @error('social_media.instagram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="social_linkedin" class="form-label">LinkedIn</label>
                                <input type="url" class="form-control @error('social_media.linkedin') is-invalid @enderror" 
                                       id="social_linkedin" name="social_media[linkedin]" 
                                       value="{{ old('social_media.linkedin', $expert->social_media['linkedin'] ?? '') }}" 
                                       placeholder="https://linkedin.com/company/yourcompany">
                                @error('social_media.linkedin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-save me-2"></i>Update Profile
                                    </button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="{{ route('experts.show', $expert) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-eye me-2"></i>View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Handle state change to load LGAs
document.getElementById('state_id').addEventListener('change', function() {
    const stateId = this.value;
    const lgaSelect = document.getElementById('lga_id');
    
    // Clear existing options
    lgaSelect.innerHTML = '<option value="">Select LGA</option>';
    
    if (stateId) {
        // Fetch LGAs for selected state
        fetch(`/api/lgas/${stateId}`)
            .then(response => response.json())
            .then(lgas => {
                lgas.forEach(lga => {
                    const option = document.createElement('option');
                    option.value = lga.id;
                    option.textContent = lga.name;
                    lgaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error loading LGAs:', error));
    }
});
</script>
@endsection
