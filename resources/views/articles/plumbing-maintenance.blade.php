@extends('layouts.app')

@section('title', 'Plumbing Maintenance Checklist for Nigerian Homes - FindExpert')
@section('description', 'Keep your plumbing system in top condition with this comprehensive maintenance checklist. Prevent costly repairs and ensure reliable water supply.')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Article Header -->
            <div class="mb-4">
                <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                     class="img-fluid rounded mb-4" alt="Plumbing work in Nigeria">
                <h1 class="display-4 fw-bold">Plumbing Maintenance Checklist for Nigerian Homes</h1>
                <p class="lead text-muted">Keep your plumbing system in top condition with this comprehensive maintenance checklist. Prevent costly repairs and ensure reliable water supply.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Published: December 2024 | 4 min read</small>
                    <div>
                        <a href="{{ route('articles') }}" class="btn btn-outline-primary btn-sm">← Back to Articles</a>
                    </div>
                </div>
            </div>

            <!-- Article Content -->
            <div class="article-content">
                <h2>Introduction</h2>
                <p>Proper plumbing maintenance is essential for Nigerian homes, where water supply can be inconsistent and plumbing systems face unique challenges. This comprehensive checklist will help you maintain your plumbing system and prevent costly repairs.</p>

                <h2>1. Understanding Nigerian Plumbing Challenges</h2>
                <p>Nigerian homes face specific plumbing challenges:</p>
                <ul>
                    <li>Inconsistent water pressure from municipal supply</li>
                    <li>Frequent power outages affecting water pumps</li>
                    <li>Hard water causing mineral buildup</li>
                    <li>Older plumbing systems in many homes</li>
                    <li>Mixed use of different pipe materials</li>
                </ul>

                <h2>2. Daily Maintenance Tasks</h2>
                
                <h3>2.1 Check for Leaks</h3>
                <p>Daily leak checks can prevent major damage:</p>
                <ul>
                    <li>Inspect under sinks for water stains</li>
                    <li>Check toilet base for water pooling</li>
                    <li>Look for water stains on ceilings</li>
                    <li>Monitor water meter for unexpected usage</li>
                </ul>

                <h3>2.2 Monitor Water Pressure</h3>
                <p>Consistent water pressure monitoring helps identify problems early:</p>
                <ul>
                    <li>Note changes in shower pressure</li>
                    <li>Check if faucets have consistent flow</li>
                    <li>Listen for unusual sounds in pipes</li>
                    <li>Monitor pump operation if applicable</li>
                </ul>

                <h2>3. Weekly Maintenance Tasks</h2>
                
                <h3>3.1 Clean Drains</h3>
                <p>Prevent clogs with regular cleaning:</p>
                <ul>
                    <li>Pour hot water down drains weekly</li>
                    <li>Use baking soda and vinegar monthly</li>
                    <li>Remove hair from shower drains</li>
                    <li>Clean sink strainers regularly</li>
                </ul>

                <h3>3.2 Inspect Visible Pipes</h3>
                <p>Check exposed pipes for signs of damage:</p>
                <ul>
                    <li>Look for corrosion or rust</li>
                    <li>Check for loose connections</li>
                    <li>Inspect pipe supports and hangers</li>
                    <li>Look for signs of condensation</li>
                </ul>

                <h2>4. Monthly Maintenance Tasks</h2>
                
                <h3>4.1 Test Water Quality</h3>
                <p>Regular water quality checks are important:</p>
                <ul>
                    <li>Check water color and clarity</li>
                    <li>Test for unusual odors</li>
                    <li>Monitor taste changes</li>
                    <li>Consider professional water testing annually</li>
                </ul>

                <h3>4.2 Inspect Water Heater</h3>
                <p>If you have a water heater, monthly checks are essential:</p>
                <ul>
                    <li>Check for leaks around the unit</li>
                    <li>Test temperature and pressure relief valve</li>
                    <li>Inspect for rust or corrosion</li>
                    <li>Check pilot light (gas heaters)</li>
                </ul>

                <h2>5. Seasonal Maintenance</h2>
                
                <h3>5.1 Dry Season (November - March)</h3>
                <p>Focus on water conservation and pump maintenance:</p>
                <ul>
                    <li>Check water storage tanks for leaks</li>
                    <li>Inspect pump systems thoroughly</li>
                    <li>Clean water filters and screens</li>
                    <li>Test backup water systems</li>
                </ul>

                <h3>5.2 Rainy Season (April - October)</h3>
                <p>Prepare for increased water pressure and flooding risks:</p>
                <ul>
                    <li>Check drainage systems</li>
                    <li>Inspect sump pumps if applicable</li>
                    <li>Clear gutters and downspouts</li>
                    <li>Check for foundation leaks</li>
                </ul>

                <h2>6. Annual Professional Maintenance</h2>
                <p>Schedule annual professional inspections:</p>
                
                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle me-2"></i>Professional Inspection Checklist:</h5>
                    <ul class="mb-0">
                        <li>Complete system pressure test</li>
                        <li>Water heater service and cleaning</li>
                        <li>Pipe inspection with cameras if needed</li>
                        <li>Water quality testing</li>
                        <li>Septic tank inspection (if applicable)</li>
                        <li>Well water system check (if applicable)</li>
                    </ul>
                </div>

                <h2>7. Common Plumbing Problems in Nigeria</h2>
                
                <h3>7.1 Low Water Pressure</h3>
                <p>Causes and solutions:</p>
                <ul>
                    <li><strong>Clogged aerators:</strong> Clean or replace faucet aerators</li>
                    <li><strong>Mineral buildup:</strong> Use vinegar to dissolve deposits</li>
                    <li><strong>Pipe corrosion:</strong> May require pipe replacement</li>
                    <li><strong>Municipal supply issues:</strong> Contact water authority</li>
                </ul>

                <h3>7.2 Frequent Clogs</h3>
                <p>Prevention and treatment:</p>
                <ul>
                    <li>Use drain strainers in all sinks</li>
                    <li>Avoid pouring grease down drains</li>
                    <li>Regular drain cleaning with natural solutions</li>
                    <li>Professional drain cleaning if needed</li>
                </ul>

                <h2>8. Emergency Preparedness</h2>
                
                <h3>8.1 Emergency Shut-off Locations</h3>
                <p>Know where to shut off water in emergencies:</p>
                <ul>
                    <li>Main water shut-off valve</li>
                    <li>Individual fixture shut-offs</li>
                    <li>Water heater shut-off</li>
                    <li>Pump system shut-off</li>
                </ul>

                <h3>8.2 Emergency Kit</h3>
                <p>Keep these items handy:</p>
                <ul>
                    <li>Pipe wrench and adjustable wrench</li>
                    <li>Plumber's tape (Teflon tape)</li>
                    <li>Pipe clamps and repair sleeves</li>
                    <li>Emergency shut-off tool</li>
                    <li>Contact information for emergency plumbers</li>
                </ul>

                <h2>9. Water Conservation Tips</h2>
                <p>Conserve water and reduce utility bills:</p>
                <ul>
                    <li>Fix leaks immediately</li>
                    <li>Install low-flow faucets and showerheads</li>
                    <li>Use water-efficient appliances</li>
                    <li>Collect rainwater for non-potable uses</li>
                    <li>Insulate hot water pipes</li>
                </ul>

                <h2>10. When to Call a Professional</h2>
                <p>Some plumbing issues require professional attention:</p>
                <ul>
                    <li>Major leaks or burst pipes</li>
                    <li>Sewer line problems</li>
                    <li>Water heater installation or repair</li>
                    <li>Pipe replacement or rerouting</li>
                    <li>Septic system issues</li>
                    <li>Complex clogs that resist DIY methods</li>
                </ul>

                <h2>11. Cost of Plumbing Services in Nigeria</h2>
                <p>Plumbing service costs vary by location and complexity:</p>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Cost Range (₦)</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Basic leak repair</td>
                                <td>₦5,000 - ₦15,000</td>
                                <td>Depends on location and complexity</td>
                            </tr>
                            <tr>
                                <td>Drain cleaning</td>
                                <td>₦3,000 - ₦8,000</td>
                                <td>Per drain or fixture</td>
                            </tr>
                            <tr>
                                <td>Toilet installation</td>
                                <td>₦15,000 - ₦35,000</td>
                                <td>Includes labor and basic materials</td>
                            </tr>
                            <tr>
                                <td>Water heater repair</td>
                                <td>₦10,000 - ₦50,000</td>
                                <td>Depends on problem and heater type</td>
                            </tr>
                            <tr>
                                <td>Pipe replacement (per meter)</td>
                                <td>₦2,000 - ₦5,000</td>
                                <td>Depends on pipe material and location</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h2>12. Maintenance Schedule Summary</h2>
                <p>Here's a quick reference for your plumbing maintenance:</p>
                
                <div class="row">
                    <div class="col-md-4">
                        <h5>Daily</h5>
                        <ul>
                            <li>Check for leaks</li>
                            <li>Monitor water pressure</li>
                            <li>Look for water stains</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Weekly</h5>
                        <ul>
                            <li>Clean drains</li>
                            <li>Inspect visible pipes</li>
                            <li>Check pump operation</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Monthly</h5>
                        <ul>
                            <li>Test water quality</li>
                            <li>Inspect water heater</li>
                            <li>Clean aerators</li>
                        </ul>
                    </div>
                </div>

                <h2>Conclusion</h2>
                <p>Regular plumbing maintenance is essential for Nigerian homes. By following this checklist and addressing problems early, you can prevent costly repairs and ensure reliable water supply for your family.</p>

                <div class="alert alert-success">
                    <h5><i class="fas fa-lightbulb me-2"></i>Pro Tip:</h5>
                    <p class="mb-0">Keep a maintenance log to track when you perform each task. This helps identify patterns and ensures nothing is overlooked.</p>
                </div>

                <!-- Call to Action -->
                <div class="card bg-primary text-white mt-5">
                    <div class="card-body text-center">
                        <h4>Need Plumbing Services?</h4>
                        <p>Find qualified plumbers in your area</p>
                        <a href="{{ route('experts.index', ['category' => 'plumbers']) }}" class="btn btn-light btn-lg">
                            <i class="fas fa-search me-2"></i>Find Plumbers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
