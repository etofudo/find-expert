@extends('layouts.app')

@section('title', 'Terms of Service - FindExpert')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="mb-4">Terms of Service</h1>
            <p class="text-muted">Last updated: {{ date('F d, Y') }}</p>
            
            <div class="card">
                <div class="card-body">
                    <h2>1. Acceptance of Terms</h2>
                    <p>By accessing and using FindExpert ("the Service"), you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.</p>
                    
                    <h2>2. Use License</h2>
                    <p>Permission is granted to temporarily download one copy of FindExpert per device for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:</p>
                    <ul>
                        <li>modify or copy the materials</li>
                        <li>use the materials for any commercial purpose or for any public display</li>
                        <li>attempt to reverse engineer any software contained on FindExpert</li>
                        <li>remove any copyright or other proprietary notations from the materials</li>
                    </ul>
                    
                    <h2>3. User Accounts</h2>
                    <p>When you create an account with us, you must provide information that is accurate, complete, and current at all times. You are responsible for safeguarding the password and for all activities that occur under your account.</p>
                    
                    <h2>4. Business Listings</h2>
                    <p>Businesses listed on FindExpert are responsible for:</p>
                    <ul>
                        <li>Providing accurate and up-to-date information</li>
                        <li>Maintaining the quality of their services</li>
                        <li>Complying with all applicable laws and regulations</li>
                        <li>Resolving disputes with clients directly</li>
                    </ul>
                    
                    <h2>5. Prohibited Uses</h2>
                    <p>You may not use our service:</p>
                    <ul>
                        <li>For any unlawful purpose or to solicit others to perform unlawful acts</li>
                        <li>To violate any international, federal, provincial, or state regulations, rules, laws, or local ordinances</li>
                        <li>To infringe upon or violate our intellectual property rights or the intellectual property rights of others</li>
                        <li>To harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate</li>
                        <li>To submit false or misleading information</li>
                    </ul>
                    
                    <h2>6. Content</h2>
                    <p>Our Service allows you to post, link, store, share and otherwise make available certain information, text, graphics, videos, or other material. You are responsible for the content that you post to the Service, including its legality, reliability, and appropriateness.</p>
                    
                    <h2>7. Disclaimer</h2>
                    <p>The information on this website is provided on an "as is" basis. To the fullest extent permitted by law, this Company:</p>
                    <ul>
                        <li>excludes all representations and warranties relating to this website and its contents</li>
                        <li>excludes all liability for damages arising out of or in connection with your use of this website</li>
                    </ul>
                    
                    <h2>8. Limitations</h2>
                    <p>In no event shall FindExpert or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on FindExpert, even if FindExpert or a FindExpert authorized representative has been notified orally or in writing of the possibility of such damage.</p>
                    
                    <h2>9. Accuracy of Materials</h2>
                    <p>The materials appearing on FindExpert could include technical, typographical, or photographic errors. FindExpert does not warrant that any of the materials on its website are accurate, complete or current. FindExpert may make changes to the materials contained on its website at any time without notice.</p>
                    
                    <h2>10. Links</h2>
                    <p>FindExpert has not reviewed all of the sites linked to our website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by FindExpert of the site. Use of any such linked website is at the user's own risk.</p>
                    
                    <h2>11. Modifications</h2>
                    <p>FindExpert may revise these terms of service for its website at any time without notice. By using this website you are agreeing to be bound by the then current version of these terms of service.</p>
                    
                    <h2>12. Governing Law</h2>
                    <p>These terms and conditions are governed by and construed in accordance with the laws of Nigeria and you irrevocably submit to the exclusive jurisdiction of the courts in that state or location.</p>
                    
                    <h2>13. Contact Information</h2>
                    <p>If you have any questions about these Terms of Service, please contact us:</p>
                    <ul>
                        <li><strong>Email:</strong> legal@findexpert.com.ng</li>
                        <li><strong>Website:</strong> <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
