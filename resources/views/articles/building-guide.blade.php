@extends('layouts.app')

@section('title', 'Complete Guide to Building a House in Nigeria - FindExpert')
@section('description', 'Everything you need to know about building your dream home in Nigeria. Complete guide covering costs, permits, materials, and timeline expectations.')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Article Header -->
            <div class="mb-4">
                <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                     class="img-fluid rounded mb-4" alt="Construction site in Nigeria">
                <h1 class="display-4 fw-bold">Complete Guide to Building a House in Nigeria</h1>
                <p class="lead text-muted">Everything you need to know about building your dream home in Nigeria, from land acquisition to final inspection.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Published: December 2024 | 15 min read</small>
                    <div>
                        <a href="{{ route('articles') }}" class="btn btn-outline-primary btn-sm">← Back to Articles</a>
                    </div>
                </div>
            </div>

            <!-- Article Content -->
            <div class="article-content">
                <h2>Introduction</h2>
                <p>Building a house in Nigeria is a significant investment that requires careful planning, proper documentation, and the right professionals. This comprehensive guide will walk you through every step of the process, from initial planning to final inspection, ensuring your construction project is successful and stress-free.</p>

                <h2>1. Pre-Construction Planning</h2>
                
                <h3>1.1 Land Acquisition and Documentation</h3>
                <p>Before you can start building, you need to secure the right piece of land. Here's what to consider:</p>
                <ul>
                    <li><strong>Location:</strong> Choose a location that suits your lifestyle, work, and family needs</li>
                    <li><strong>Accessibility:</strong> Ensure good road access and proximity to essential services</li>
                    <li><strong>Soil Quality:</strong> Conduct soil tests to determine foundation requirements</li>
                    <li><strong>Legal Documentation:</strong> Verify land ownership and obtain necessary documents</li>
                </ul>

                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle me-2"></i>Important Documents Needed:</h5>
                    <ul class="mb-0">
                        <li>Certificate of Occupancy (C of O)</li>
                        <li>Survey Plan</li>
                        <li>Deed of Assignment</li>
                        <li>Receipt of Purchase</li>
                        <li>Tax Clearance Certificate</li>
                    </ul>
                </div>

                <h3>1.2 Budget Planning</h3>
                <p>Creating a realistic budget is crucial for a successful construction project. Consider these cost factors:</p>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Direct Costs:</h5>
                        <ul>
                            <li>Land acquisition (20-30%)</li>
                            <li>Construction materials (40-50%)</li>
                            <li>Labor costs (20-30%)</li>
                            <li>Professional fees (5-10%)</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Hidden Costs:</h5>
                        <ul>
                            <li>Permits and approvals (2-5%)</li>
                            <li>Utilities connection (3-5%)</li>
                            <li>Contingency fund (10-15%)</li>
                            <li>Furnishing and finishing (10-20%)</li>
                        </ul>
                    </div>
                </div>

                <h2>2. Legal Requirements and Permits</h2>
                
                <h3>2.1 Building Permits</h3>
                <p>In Nigeria, you need several permits before construction can begin:</p>
                <ul>
                    <li><strong>Building Plan Approval:</strong> Submit architectural drawings to the local planning authority</li>
                    <li><strong>Environmental Impact Assessment (EIA):</strong> Required for large projects</li>
                    <li><strong>Fire Service Approval:</strong> Ensure fire safety compliance</li>
                    <li><strong>Utility Approvals:</strong> Get approval for water, electricity, and sewage connections</li>
                </ul>

                <h3>2.2 Professional Requirements</h3>
                <p>You'll need to engage several professionals:</p>
                <ul>
                    <li><strong>Architect:</strong> For design and planning</li>
                    <li><strong>Structural Engineer:</strong> For structural integrity</li>
                    <li><strong>Quantity Surveyor:</strong> For cost estimation and project management</li>
                    <li><strong>Main Contractor:</strong> For actual construction work</li>
                </ul>

                <h2>3. Construction Process</h2>
                
                <h3>3.1 Foundation Stage</h3>
                <p>The foundation is the most critical part of your building. In Nigeria, common foundation types include:</p>
                <ul>
                    <li><strong>Strip Foundation:</strong> Most common for residential buildings</li>
                    <li><strong>Raft Foundation:</strong> For areas with poor soil conditions</li>
                    <li><strong>Pile Foundation:</strong> For high-rise buildings or very poor soil</li>
                </ul>

                <h3>3.2 Superstructure</h3>
                <p>This includes walls, columns, beams, and slabs. Common materials used in Nigeria:</p>
                <ul>
                    <li><strong>Blocks:</strong> Sandcrete blocks (most common) or concrete blocks</li>
                    <li><strong>Reinforcement:</strong> Steel bars for structural strength</li>
                    <li><strong>Concrete:</strong> Mix of cement, sand, and gravel</li>
                </ul>

                <h3>3.3 Finishing</h3>
                <p>The finishing stage includes:</p>
                <ul>
                    <li>Plastering and painting</li>
                    <li>Flooring (tiles, marble, or wood)</li>
                    <li>Electrical and plumbing installations</li>
                    <li>Roofing and waterproofing</li>
                    <li>Windows and doors installation</li>
                </ul>

                <h2>4. Cost Breakdown by State</h2>
                <p>Construction costs vary significantly across Nigeria. Here's a rough estimate per square meter:</p>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>State</th>
                                <th>Cost per m² (₦)</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lagos</td>
                                <td>₦80,000 - ₦120,000</td>
                                <td>Most expensive due to high land and labor costs</td>
                            </tr>
                            <tr>
                                <td>Abuja</td>
                                <td>₦70,000 - ₦100,000</td>
                                <td>High demand, good infrastructure</td>
                            </tr>
                            <tr>
                                <td>Rivers</td>
                                <td>₦60,000 - ₦90,000</td>
                                <td>Oil industry influence on costs</td>
                            </tr>
                            <tr>
                                <td>Kano</td>
                                <td>₦50,000 - ₦80,000</td>
                                <td>Lower labor costs, good materials availability</td>
                            </tr>
                            <tr>
                                <td>Other States</td>
                                <td>₦40,000 - ₦70,000</td>
                                <td>Generally more affordable</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h2>5. Timeline Expectations</h2>
                <p>A typical residential construction project in Nigeria takes 6-12 months, depending on size and complexity:</p>
                <ul>
                    <li><strong>Planning and Permits:</strong> 2-4 months</li>
                    <li><strong>Foundation:</strong> 2-4 weeks</li>
                    <li><strong>Superstructure:</strong> 2-4 months</li>
                    <li><strong>Finishing:</strong> 2-3 months</li>
                    <li><strong>Final Inspection:</strong> 2-4 weeks</li>
                </ul>

                <h2>6. Common Challenges and Solutions</h2>
                
                <h3>6.1 Weather Delays</h3>
                <p>Nigeria's rainy season can significantly delay construction. Plan your project timeline around weather patterns and have contingency plans.</p>

                <h3>6.2 Material Availability</h3>
                <p>Some materials may not be readily available in certain areas. Order materials in advance and have backup suppliers.</p>

                <h3>6.3 Labor Issues</h3>
                <p>Skilled labor can be scarce. Hire experienced contractors and ensure proper supervision throughout the project.</p>

                <h2>7. Quality Control and Inspection</h2>
                <p>Regular inspections are crucial for maintaining quality:</p>
                <ul>
                    <li>Foundation inspection before proceeding</li>
                    <li>Structural inspection at key stages</li>
                    <li>Electrical and plumbing inspections</li>
                    <li>Final inspection before handover</li>
                </ul>

                <h2>8. Post-Construction</h2>
                <p>After construction completion:</p>
                <ul>
                    <li>Obtain Certificate of Completion</li>
                    <li>Register the property with relevant authorities</li>
                    <li>Set up utilities and services</li>
                    <li>Plan for regular maintenance</li>
                </ul>

                <h2>Conclusion</h2>
                <p>Building a house in Nigeria requires careful planning, proper documentation, and the right professionals. By following this guide and working with experienced contractors, you can successfully build your dream home while avoiding common pitfalls.</p>

                <div class="alert alert-success">
                    <h5><i class="fas fa-lightbulb me-2"></i>Pro Tip:</h5>
                    <p class="mb-0">Always work with verified professionals. Use FindExpert to find qualified architects, contractors, and other construction professionals in your area.</p>
                </div>

                <!-- Call to Action -->
                <div class="card bg-primary text-white mt-5">
                    <div class="card-body text-center">
                        <h4>Ready to Start Your Construction Project?</h4>
                        <p>Find verified construction professionals in your area</p>
                        <a href="{{ route('experts.index') }}" class="btn btn-light btn-lg">
                            <i class="fas fa-search me-2"></i>Find Your Expert
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
