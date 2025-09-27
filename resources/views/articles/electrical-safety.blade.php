@extends('layouts.app')

@section('title', 'Electrical Safety in Nigerian Homes - FindExpert')
@section('description', 'Essential electrical safety tips for Nigerian homeowners. Learn about proper wiring, surge protection, and choosing qualified electricians.')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Article Header -->
            <div class="mb-4">
                <img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                     class="img-fluid rounded mb-4" alt="Electrical work in Nigerian home">
                <h1 class="display-4 fw-bold">Electrical Safety in Nigerian Homes</h1>
                <p class="lead text-muted">Essential electrical safety tips for Nigerian homeowners. Learn about proper wiring, surge protection, and how to choose qualified electricians.</p>
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Published: December 2024 | 5 min read</small>
                    <div>
                        <a href="{{ route('articles') }}" class="btn btn-outline-primary btn-sm">← Back to Articles</a>
                    </div>
                </div>
            </div>

            <!-- Article Content -->
            <div class="article-content">
                <h2>Introduction</h2>
                <p>Electrical safety is crucial in Nigerian homes, where power supply can be inconsistent and electrical systems often face unique challenges. This guide provides essential safety tips to protect your family and property from electrical hazards.</p>

                <h2>1. Understanding Nigeria's Electrical System</h2>
                <p>Nigeria operates on a 230V/50Hz electrical system, but power supply is often unreliable. This creates unique challenges:</p>
                <ul>
                    <li>Frequent power outages requiring generators and inverters</li>
                    <li>Voltage fluctuations that can damage appliances</li>
                    <li>Inconsistent grounding in older buildings</li>
                    <li>Mixed use of different electrical standards</li>
                </ul>

                <h2>2. Common Electrical Hazards in Nigerian Homes</h2>
                
                <h3>2.1 Overloaded Circuits</h3>
                <p>Many Nigerian homes have outdated electrical systems that can't handle modern appliance loads:</p>
                <ul>
                    <li>Multiple appliances on single outlets</li>
                    <li>Extension cords used as permanent wiring</li>
                    <li>Inadequate circuit breakers</li>
                </ul>

                <h3>2.2 Poor Grounding</h3>
                <p>Inadequate grounding is a major safety concern:</p>
                <ul>
                    <li>Many older buildings lack proper grounding</li>
                    <li>Generator connections without proper grounding</li>
                    <li>Water pipes used as grounding (unsafe)</li>
                </ul>

                <h3>2.3 Voltage Fluctuations</h3>
                <p>Nigerian power supply is known for voltage variations:</p>
                <ul>
                    <li>Low voltage can damage motors and compressors</li>
                    <li>High voltage can cause fires and equipment damage</li>
                    <li>Sudden power restoration can cause surges</li>
                </ul>

                <h2>3. Essential Safety Measures</h2>
                
                <h3>3.1 Proper Wiring</h3>
                <p>Ensure your home has proper electrical wiring:</p>
                <ul>
                    <li>Use appropriate wire sizes for load requirements</li>
                    <li>Install proper circuit breakers and fuses</li>
                    <li>Use conduit for protection in exposed areas</li>
                    <li>Label all electrical panels clearly</li>
                </ul>

                <h3>3.2 Surge Protection</h3>
                <p>Protect your appliances from power surges:</p>
                <ul>
                    <li>Install whole-house surge protectors</li>
                    <li>Use surge protectors for sensitive electronics</li>
                    <li>Consider voltage stabilizers for major appliances</li>
                    <li>Unplug electronics during storms</li>
                </ul>

                <h3>3.3 Grounding and Bonding</h3>
                <p>Proper grounding is essential for safety:</p>
                <ul>
                    <li>Install proper grounding rods</li>
                    <li>Ensure all metal parts are bonded</li>
                    <li>Test grounding systems regularly</li>
                    <li>Never use water pipes as grounding</li>
                </ul>

                <h2>4. Generator Safety</h2>
                <p>Generators are common in Nigerian homes but pose serious risks:</p>
                
                <div class="alert alert-warning">
                    <h5><i class="fas fa-exclamation-triangle me-2"></i>Critical Safety Rules:</h5>
                    <ul class="mb-0">
                        <li>Never run generators indoors or in enclosed spaces</li>
                        <li>Keep generators at least 20 feet from windows and doors</li>
                        <li>Use proper transfer switches, never back-feed into main panel</li>
                        <li>Allow generators to cool before refueling</li>
                        <li>Store fuel safely away from living areas</li>
                    </ul>
                </div>

                <h2>5. Appliance Safety</h2>
                
                <h3>5.1 Regular Maintenance</h3>
                <p>Keep your electrical appliances safe:</p>
                <ul>
                    <li>Inspect cords regularly for damage</li>
                    <li>Replace damaged cords immediately</li>
                    <li>Clean appliances to prevent overheating</li>
                    <li>Follow manufacturer maintenance schedules</li>
                </ul>

                <h3>5.2 Proper Usage</h3>
                <p>Use appliances safely:</p>
                <ul>
                    <li>Don't overload outlets or extension cords</li>
                    <li>Unplug appliances when not in use</li>
                    <li>Keep electrical appliances away from water</li>
                    <li>Use appliances according to manufacturer instructions</li>
                </ul>

                <h2>6. Choosing Qualified Electricians</h2>
                <p>Electrical work should always be done by qualified professionals:</p>
                
                <h3>6.1 What to Look For</h3>
                <ul>
                    <li>Valid electrical contractor license</li>
                    <li>Insurance coverage</li>
                    <li>References from previous clients</li>
                    <li>Knowledge of Nigerian electrical codes</li>
                    <li>Experience with local power systems</li>
                </ul>

                <h3>6.2 Questions to Ask</h3>
                <ul>
                    <li>Are you licensed and insured?</li>
                    <li>Can you provide references?</li>
                    <li>Do you follow Nigerian electrical codes?</li>
                    <li>What warranty do you provide?</li>
                    <li>Can you provide a written estimate?</li>
                </ul>

                <h2>7. Emergency Procedures</h2>
                
                <h3>7.1 Electrical Fires</h3>
                <p>If an electrical fire occurs:</p>
                <ul>
                    <li>Turn off power at the main breaker</li>
                    <li>Use a Class C fire extinguisher (never water)</li>
                    <li>Evacuate the building immediately</li>
                    <li>Call emergency services</li>
                </ul>

                <h3>7.2 Electrical Shock</h3>
                <p>If someone is electrocuted:</p>
                <ul>
                    <li>Turn off power immediately</li>
                    <li>Don't touch the person until power is off</li>
                    <li>Call emergency services</li>
                    <li>Begin CPR if trained and necessary</li>
                </ul>

                <h2>8. Regular Safety Inspections</h2>
                <p>Schedule regular electrical safety inspections:</p>
                <ul>
                    <li>Annual inspections by qualified electricians</li>
                    <li>Check for loose connections</li>
                    <li>Test ground fault circuit interrupters (GFCIs)</li>
                    <li>Inspect electrical panels and breakers</li>
                    <li>Check for signs of overheating or damage</li>
                </ul>

                <h2>9. Signs of Electrical Problems</h2>
                <p>Watch for these warning signs:</p>
                <ul>
                    <li>Frequent circuit breaker trips</li>
                    <li>Flickering or dimming lights</li>
                    <li>Burning smells or unusual sounds</li>
                    <li>Hot outlets or switches</li>
                    <li>Discolored outlets or switches</li>
                </ul>

                <h2>10. Cost of Electrical Work in Nigeria</h2>
                <p>Electrical work costs vary by location and complexity:</p>
                
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
                                <td>Basic wiring (per room)</td>
                                <td>₦50,000 - ₦100,000</td>
                                <td>Depends on room size and complexity</td>
                            </tr>
                            <tr>
                                <td>Generator installation</td>
                                <td>₦30,000 - ₦80,000</td>
                                <td>Includes transfer switch and wiring</td>
                            </tr>
                            <tr>
                                <td>Surge protector installation</td>
                                <td>₦20,000 - ₦50,000</td>
                                <td>Whole-house protection</td>
                            </tr>
                            <tr>
                                <td>Electrical panel upgrade</td>
                                <td>₦100,000 - ₦300,000</td>
                                <td>For older homes with outdated panels</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h2>Conclusion</h2>
                <p>Electrical safety in Nigerian homes requires understanding the unique challenges of the local power system and taking appropriate precautions. Regular maintenance, proper installation, and working with qualified professionals are essential for keeping your home and family safe.</p>

                <div class="alert alert-success">
                    <h5><i class="fas fa-lightbulb me-2"></i>Remember:</h5>
                    <p class="mb-0">When in doubt, always consult a qualified electrician. Electrical work is dangerous and should never be attempted by untrained individuals.</p>
                </div>

                <!-- Call to Action -->
                <div class="card bg-primary text-white mt-5">
                    <div class="card-body text-center">
                        <h4>Need Electrical Work Done?</h4>
                        <p>Find qualified electricians in your area</p>
                        <a href="{{ route('experts.index', ['category' => 'electrical-contractors']) }}" class="btn btn-light btn-lg">
                            <i class="fas fa-search me-2"></i>Find Electricians
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
