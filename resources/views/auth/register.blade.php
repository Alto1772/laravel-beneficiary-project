@extends('layouts/blankLayout')

@section('title', 'Register Account | ' . config('variables.templateName'))

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        @include('layouts.sections.logo')
                        {{-- <h4 class="mb-1">This is the register page</h4>
                        <p class="mb-6">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem, possimus.</p> --}}
                        <h4 class="mb-6 text-center">Register Page</h4>

                        <form id="formAuthentication" action="{{ route('register') }}" method="POST">

                            @csrf
                            <div class="mb-6">

                                <div class="mb-6">
                                    <label for="name" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter your username"
                                        value="{{ old('name') }}" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Enter your email"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group input-group-merge @error('password') is-invalid @enderror">
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-6 form-password-toggle">
                                    <label class="form-label" for="password-confirm">Confirm Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password-confirm" class="form-control"
                                            name="password_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password_confirmation" />
                                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                    </div>
                                </div>
                                <button class="btn btn-primary d-grid w-100" type="submit">
                                    Register
                                </button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}">
                                <span>Sign in instead</span>
                            </a>
                        </p>

                        <!-- Back to Main Page -->
                        <p class="text-center">
                            <a href="{{ url('/') }}">
                                <span>Back to Main Page</span>
                            </a>
                        </p>
                        <!-- /Back to Main Page -->
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
@endsection
