@extends('layouts.app')

@section('title', 'Privacy Policy - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">Privacy Policy</h1>
            <p class="text-muted">Last updated: {{ date('F d, Y') }}</p>
            
            <div class="card">
                <div class="card-body">
                    <h2>1. Introduction</h2>
                    <p>FindExpert ("we," "our," or "us") operates the website findexpert.com.ng (the "Service"). This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.</p>
                    
                    <h2>2. Information We Collect</h2>
                    <h3>2.1 Information You Provide</h3>
                    <ul>
                        <li><strong>Business Registration:</strong> When you register your business, we collect your business name, contact information, service category, and description.</li>
                        <li><strong>Contact Information:</strong> Phone numbers, email addresses, and physical addresses you provide.</li>
                        <li><strong>Website Information:</strong> Website URLs and social media links you choose to share.</li>
                    </ul>
                    
                    <h3>2.2 Information We Collect Automatically</h3>
                    <ul>
                        <li><strong>Usage Data:</strong> Information about how you access and use our Service, including your IP address, browser type, pages visited, and time spent on our site.</li>
                        <li><strong>Cookies:</strong> We use cookies and similar tracking technologies to enhance your experience and analyze site usage.</li>
                    </ul>
                    
                    <h2>3. How We Use Your Information</h2>
                    <p>We use the information we collect to:</p>
                    <ul>
                        <li>Provide and maintain our Service</li>
                        <li>Display your business information in our directory</li>
                        <li>Communicate with you about your listing</li>
                        <li>Improve our Service and develop new features</li>
                        <li>Analyze usage patterns and optimize our website</li>
                        <li>Comply with legal obligations</li>
                    </ul>
                    
                    <h2>4. Information Sharing and Disclosure</h2>
                    <p>We do not sell, trade, or otherwise transfer your personal information to third parties except in the following circumstances:</p>
                    <ul>
                        <li><strong>Public Directory:</strong> Business information you provide will be displayed publicly in our directory as intended.</li>
                        <li><strong>Service Providers:</strong> We may share information with trusted third parties who assist us in operating our website, conducting our business, or serving our users.</li>
                        <li><strong>Legal Requirements:</strong> We may disclose information when required by law or to protect our rights, property, or safety.</li>
                    </ul>
                    
                    <h2>5. Data Security</h2>
                    <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. However, no method of transmission over the internet or electronic storage is 100% secure.</p>
                    
                    <h2>6. Cookies and Tracking Technologies</h2>
                    <p>We use cookies and similar technologies to:</p>
                    <ul>
                        <li>Remember your preferences and settings</li>
                        <li>Analyze site traffic and usage patterns</li>
                        <li>Provide personalized content and advertisements</li>
                        <li>Improve our Service functionality</li>
                    </ul>
                    <p>You can control cookie settings through your browser preferences.</p>
                    
                    <h2>7. Third-Party Services</h2>
                    <p>Our Service may contain links to third-party websites or services. We are not responsible for the privacy practices of these external sites. We encourage you to review their privacy policies before providing any personal information.</p>
                    
                    <h2>8. Google AdSense</h2>
                    <p>We use Google AdSense to display advertisements on our website. Google may use cookies to serve ads based on your visits to our site and other sites on the internet. You can opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" target="_blank">Google Ad Settings</a>.</p>
                    
                    <h2>9. Data Retention</h2>
                    <p>We retain your personal information for as long as necessary to provide our Service and fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required by law.</p>
                    
                    <h2>10. Your Rights</h2>
                    <p>You have the right to:</p>
                    <ul>
                        <li>Access your personal information</li>
                        <li>Correct inaccurate information</li>
                        <li>Request deletion of your information</li>
                        <li>Opt out of certain communications</li>
                        <li>Withdraw consent where applicable</li>
                    </ul>
                    
                    <h2>11. Children's Privacy</h2>
                    <p>Our Service is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13.</p>
                    
                    <h2>12. Changes to This Privacy Policy</h2>
                    <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.</p>
                    
                    <h2>13. Contact Us</h2>
                    <p>If you have any questions about this Privacy Policy, please contact us:</p>
                    <ul>
                        <li><strong>Email:</strong> privacy@findexpert.com.ng</li>
                        <li><strong>Website:</strong> <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
