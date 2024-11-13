@extends('layouts/blankLayout')

@section('title', '500 Internal Error')

@section('page-style')
    <!-- Page -->
    @vite(['resources/assets/vendor/scss/pages/page-misc.scss'])
@endsection


@section('content')
    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h1 class="mb-2 mx-2" style="line-height: 6rem;font-size: 6rem;">500</h1>
            <h4 class="mb-2 mx-2">Internal Server Error 😱</h4>
            <p class="mb-2 mx-2">it seems that the server has encountered an error!</p>
            <p class="mb-6 mx-2">Please try again later.</p>
            <div class="d-flex gap-3">
                <a href="{{ url('/') }}" class="btn btn-primary"><i class="bx bx-home-alt-2 me-1"></i>Back to Home</a>
                <a href="{{ url()->full() }}" class="btn btn-danger"><i class="bx bx-refresh me-1"></i> Reload page</a>
            </div>
            <div class="mt-6">
                <img src="{{ asset('assets/img/illustrations/page-misc-error-light.png') }}" alt="page-misc-error-light"
                    width="500" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- /Error -->
@endsection
