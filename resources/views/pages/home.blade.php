@extends('layouts/contentNavbarLayout', ['isMenu' => false, 'isMainNavbar' => true, 'navbarFull' => true])

@section('title', 'Home page')

@section('content')
    <!-- Home Section -->
    <section id="home" class="container-xxl container-p-y text-center">
        <div class="container py-5 bg-success rounded-3 bg-opacity-25">
            <div class="d-flex align-items-start gap-2 flex-column">
                <h1 class="display-4">Welcome to DOLE Tupad #BKBK Program</h1>
                <p class="lead">Empowering Disadvantaged and Displaced Workers through Community Support.</p>
                <a href="#contact" class="btn btn-success btn-lg">Get Involved</a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="container-fluid container-p-y">
        <div class="container py-5 bg-light rounded-3">
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

    <!-- Projects Section -->
    <section i class="container-fluid container-p-y">
        <div class="container py-5">
            <h2 class="text-center mb-5">Eligible Projects</h2>
            <h3 class="text-center fw-light mb-5">Emergency Response</h3>
            <div class="row">
                <div class="col-md-4 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/street-lamp.png') }}"
                            alt="street cleaning graphic icon"
                            class="img-fluid border border-5 border-primary rounded-circle p-1" width="128px">
                    </div>
                    <p>Light works such as street sweeping and cleaning of public facilities</p>
                </div>
                <div class="col-md-4 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/trolley.png') }}" alt="shopping cart graphic icon"
                            class="img-fluid border border-5 border-primary rounded-circle p-1" width="128px">
                    </div>
                    <p>Assistance to LGUs through delivery of essential goods and services, packing/repacking of relief
                        goods, preparation and dissemination of IEC materials in rural areas, and related tasks</p>
                </div>
                <div class="col-md-4 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/plant-on-hands.png') }}"
                            alt="plant on hands graphic icon"
                            class="img-fluid border border-5 border-primary rounded-circle p-1" width="128px">
                    </div>
                    <p>Agro-forestry projects including tree planting, seedling preparation, reforestation, mangrove and
                        bamboo planting, crop growing, and vegetable farming requiring land preparation</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/delivery-bike.png') }}"
                            alt="delivery bike graphic icon"
                            class="img-fluid border border-5 border-primary rounded-circle p-1" width="128px">
                    </div>
                    <p>Transport services for setting up mobile markets</p>
                </div>
                <div class="col-md-6 text-center mb-5">
                    <div class="mb-3">
                        <img src="{{ asset('assets/img/icons/flaticon/cleaning-spray.png') }}" alt="hand spray graphic icon"
                            class="img-fluid border border-5 border-primary rounded-circle p-1" width="128px">
                    </div>
                    <p>Community disinfection/sanitation activities</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="container-fluid container-p-y">
        <div class="container py-5 bg-light rounded-3">
            <h2 class="text-center mb-5">About Tupad #BKBK</h2>
            <p>
                The Department of Labor and Employment (DOLE) has initiated the Tulong Panghanapbuhay Sa Ating
                Disadvantaged/Displaced Workers Program (Tupad) #Barangay Ko, Bahay Ko Disinfection/Sanitation Project
                (#BKBK) aimed at assisting informal sector workers impacted by the Enhanced Community Quarantine. Below are
                the essential details:
            </p>

            <div class="accordion" id="aboutTupad">
                <div class="card accordion-item">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#whatIsTupad" aria-expanded="true" aria-controls="whatIsTupad" role="tabpanel">
                            What is TUPAD #BKBK and who are qualified for this?
                        </button>
                    </h2>


                    <div id="whatIsTupad" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p>
                                TUPAD #BKBK is a community-based safety net program designed to provide temporary employment
                                to workers from
                                the informal sectors who are underemployed, self-employed, or displaced marginalized workers
                                affected by the
                                ECQ. Eligible workers include:
                            </p>
                            <ul>
                                <li>Kasambahays</li>
                                <li>Angkas, Grab, Jeepney, and other PUV drivers</li>
                                <li>Carinderia owners, Vendors, Dishwashers</li>
                                <li>Senior Citizens fit to work</li>
                                <li>Independent contractors</li>
                            </ul>
                            <p>
                                Individuals below 17 years old are not eligible in accordance with the Anti-Child Labor Law.
                                Workers outside
                                ECQ regions who lost their livelihood due to COVID-19 are also covered. Beneficiaries
                                receiving financial
                                assistance from their LGUs can still apply, provided the total benefit does not exceed
                                Php8,000. Voter
                                registration in your barangay is not a requirement.
                            </p>
                            <p>
                                The program involves disinfection and sanitation of homes and their immediate surroundings.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#whatAreBenefits" aria-expanded="true" aria-controls="whatAreBenefits"
                            role="tabpanel">
                            What are the benefits?
                        </button>
                    </h2>


                    <div id="whatAreBenefits" class="accordion-collapse collapse">
                        <div class="accordion-body">

                            <p>
                                Beneficiaries receive employment for 4 hours/day over a 10-day period, with payment
                                equivalent to the
                                regional minimum wage per day. This is a one-time grant; for further assistance, DOLE can
                                refer
                                beneficiaries to DSWD. Additional benefits include personal accident insurance, health and
                                safety brochures,
                                and cleaning/disinfecting materials for barangay work.
                            </p>

                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#WhoWillSubmit" aria-expanded="true" aria-controls="WhoWillSubmit"
                            role="tabpanel">
                            Who will submit the application?
                        </button>
                    </h2>


                    <div id="WhoWillSubmit" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            Applications are facilitated by barangay captains, mayors, or other local government officials
                            and should be
                            submitted to the nearest DOLE Regional Office, Provincial, or Field Office. If assistance is
                            needed, contact
                            the DOLE-1349 hotline.
                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#WhatAreReqs" aria-expanded="true" aria-controls="WhatAreReqs"
                            role="tabpanel">
                            What are the requirements for LGUs?
                        </button>
                    </h2>


                    <div id="WhatAreReqs" class="accordion-collapse collapse">
                        <div class="accordion-body">

                            <ul>
                                <li>Letter of Intent</li>
                                <li>TUPAD Work Program</li>
                                <li>List of beneficiaries</li>
                                <li>Memorandum of Agreement (MOA) between DOLE and the Barangay/LGU or Contract of Service
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#HowToApply" aria-expanded="true" aria-controls="HowToApply"
                            role="tabpanel">
                            How to apply?
                        </button>
                    </h2>


                    <div id="HowToApply" class="accordion-collapse collapse">
                        <div class="accordion-body">

                            Workers should visit their barangay office or municipality's Public Employment Office to be
                            listed as
                            beneficiaries. Group applications should be submitted by a representative. Individual
                            applications can be
                            emailed to the regional DOLE office. DOLE will validate the applications with the respective
                            LGUs.
                        </div>
                    </div>
                </div>
                <div class="card accordion-item">
                    <h2 class="accordion-header">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#HowWillRecvPay" aria-expanded="true" aria-controls="HowWillRecvPay"
                            role="tabpanel">
                            How will the workers receive their pay?
                        </button>
                    </h2>


                    <div id="HowWillRecvPay" class="accordion-collapse collapse">
                        <div class="accordion-body">

                            Payments are made via money remittance (Palawan Express) coordinated by the LGU/barangay. 50% is
                            disbursed
                            on the 5th day of work, with the remaining 50% at the end of the 10-day period. In areas without
                            money
                            remittance services, local governments can arrange cash payouts through DOLE.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="container-fluid container-p-y">
        <div class="container py-5">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                placeholder="your.email@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection
