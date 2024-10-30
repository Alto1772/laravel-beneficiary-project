@extends('layouts/blankLayout')

@section('title', 'Login | ' . config('variables.templateName'))

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        @include('layouts.sections.logo')

                        {{-- <h4 class="mb-1">This is the Login Page</h4>
                        <p class="mb-6">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, sed.</p> --}}
                        <h4 class="mb-6 text-center">Login Page</h4>

                        <form id="formAuthentication" class="mb-6" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Enter your email address"
                                    value="{{ old('email') }}" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge  @error('password') is-invalid @enderror">
                                    <input type="password" id="password"
                                        class="form-control  @error('password') is-invalid @enderror" name="password"
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
                            <div class="mb-8">
                                <div class="d-flex justify-content-between mt-8">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" type="checkbox" id="remember-me">
                                        <label class="form-check-label" for="remember-me">
                                            Remember Me
                                        </label>
                                    </div>
                                    {{-- @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">
                                            <span>Forgot Password?</span>
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New to our site?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
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
            </div>
            <!-- /Register -->
        </div>
    </div>
@endsection
