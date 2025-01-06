@extends('layouts/contentNavbarLayout', ['isMenu' => false, 'isMainNavbar' => true, 'navbarFull' => true])

@section('title', 'Services page')

@section('content')

    <!-- Services Section -->
    <section id="services" class="container-fluid container-p-y">
        <div class="container py-5 rounded-3">
            <h2 class="text-center mb-6">Our Services</h2>
            <div class="row mb-4">
                <div class="col-md-4 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/employee-training.png') }}"
                            alt="employee training outline image" width="100px" class="img-fluid">
                    </div>
                    <h4>Employment Opportunities</h4>
                    <p>Providing temporary employment to underemployed and displaced workers affected by ECQ.</p>
                </div>
                <div class="col-md-4 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/hand-sanitizer.png') }}"
                            alt="hand sanitizer outline image" width="100px" class="img-fluid">
                    </div>
                    <h4>Sanitation Projects</h4>
                    <p>Community-based disinfection and sanitation of homes and immediate surroundings.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/healthcare.png') }}" alt="healthcare outline image"
                            width="100px" class="img-fluid">
                    </div>
                    <h4>Support & Training</h4>
                    <p>Providing personal accident insurance, health and safety brochures, and cleaning materials.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center">

                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/financial-analysis.png') }}"
                            alt="paper analysis outline image" width="100px" class="img-fluid">
                    </div>
                    <h4>Monitoring and Evaluation Services</h4>
                    <p>Implementing a web-based system to track project progress, monitor worker performance, and ensure
                        transparency and accountability in wage disbursement.</p>
                </div>
                <div class="col-md-6 text-center">

                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/social-care.png') }}" alt="social care outline image"
                            width="100px" class="img-fluid">
                    </div>
                    <h4>Community Infrastructure Support</h4>
                    <p>Engaging workers in repairing, maintaining, and improving community infrastructure such as roads,
                        drainage systems, and public facilities.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
