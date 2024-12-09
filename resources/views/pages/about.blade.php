@extends('layouts/contentNavbarLayout', ['isMenu' => false, 'isMainNavbar' => true, 'navbarFull' => true])

@section('title', 'About page')

@section('content')

    <!-- About Section -->
    <section id="about" class="container-fluid container-p-y">
        <div class="container py-5 rounded-3">
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
                            data-bs-target="#WhatAreReqs" aria-expanded="true" aria-controls="WhatAreReqs" role="tabpanel">
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
                            data-bs-target="#HowToApply" aria-expanded="true" aria-controls="HowToApply" role="tabpanel">
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

@endsection
