@extends('layouts/contentNavbarLayout', ['isMenu' => false, 'isMainNavbar' => true, 'navbarFull' => true])

@section('title', 'Services page')

@section('content')

    <!-- Services Section -->
    <section id="services" class="container-fluid container-p-y">
        <div class="container py-5 rounded-3">
            <h2 class="text-center mb-5">Our Services</h2>
            <div class="row">
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
        </div>
    </section>

@endsection
