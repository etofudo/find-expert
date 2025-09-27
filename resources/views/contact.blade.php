@extends('layouts.app')

@section('title', 'Contact Us - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">Contact Us</h1>
            <p class="lead text-muted">Get in touch with the FindExpert team. We're here to help you find the best construction professionals in Nigeria.</p>
            
            <div class="row">
                <!-- Contact Information -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Get in Touch</h3>
                            <p class="card-text">Have questions about our directory or need help finding the right expert? We're here to help!</p>
                            
                            <div class="mb-3">
                                <h6><i class="fas fa-envelope me-2 text-primary"></i>Email</h6>
                                <p class="mb-0">
                                    <a href="mailto:info@findexpert.com.ng" class="text-decoration-none">info@findexpert.com.ng</a>
                                </p>
                                <small class="text-muted">General inquiries and support</small>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="fas fa-phone me-2 text-primary"></i>Phone</h6>
                                <p class="mb-0">
                                    <a href="tel:+2348000000000" class="text-decoration-none">+234 800 000 0000</a>
                                </p>
                                <small class="text-muted">Monday - Friday, 9:00 AM - 6:00 PM WAT</small>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="fas fa-map-marker-alt me-2 text-primary"></i>Address</h6>
                                <p class="mb-0">Lagos, Nigeria</p>
                                <small class="text-muted">Serving all of Nigeria</small>
                            </div>
                            
                            <div class="mb-0">
                                <h6><i class="fas fa-clock me-2 text-primary"></i>Business Hours</h6>
                                <p class="mb-0">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="mb-0">Saturday: 10:00 AM - 4:00 PM</p>
                                <p class="mb-0">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title">Send us a Message</h3>
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject *</label>
                                    <select class="form-select" id="subject" name="subject" required>
                                        <option value="">Choose a subject</option>
                                        <option value="general">General Inquiry</option>
                                        <option value="business">Business Registration</option>
                                        <option value="support">Technical Support</option>
                                        <option value="advertising">Advertising Inquiry</option>
                                        <option value="feedback">Feedback</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message *</label>
                                    <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Please describe your inquiry in detail..."></textarea>
                                </div>
                                
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        I agree to the <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a> *
                                    </label>
                                </div>
                                
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Additional Information -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Frequently Asked Questions</h3>
                            
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq1">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
                                            How do I register my business on FindExpert?
                                        </button>
                                    </h2>
                                    <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Simply click on "Register your Business" in the navigation menu, fill out the registration form with your business details, and submit. We'll review and approve your listing within 24-48 hours.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq2">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2">
                                            Is it free to list my business?
                                        </button>
                                    </h2>
                                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Yes! Basic business listings are completely free. We also offer premium features for businesses that want enhanced visibility and additional marketing tools.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq3">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3">
                                            How do I update my business information?
                                        </button>
                                    </h2>
                                    <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            Log in to your account and click "Edit" on your business listing. You can update contact information, services, photos, and other details at any time.
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq4">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4">
                                            What areas do you cover?
                                        </button>
                                    </h2>
                                    <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            We cover all states and local government areas in Nigeria. Our directory includes construction professionals from Lagos, Abuja, Kano, Rivers, and every other state in the country.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
