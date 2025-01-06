@extends('layouts/contentNavbarLayout', ['isMenu' => false, 'isMainNavbar' => true, 'navbarFull' => true])

@section('title', 'Contact page')

@section('content')

    <!-- Contact Section -->
    <section id="contact" class="container-fluid container-p-y">
        <div class="container py-5">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row">
                <div class="col-md-7">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="your.email@example.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Your message here..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
                <div class="col-md-4 ms-5">
                    <h4 class="card-title mb-4">Contact Information</h4>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-3">
                            <strong>Address:</strong> Near at Bus Terminal Llantino Bldg., 2nd Floor, Conception, Virac,
                            Catanduanes
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection
