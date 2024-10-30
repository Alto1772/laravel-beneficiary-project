@extends('layouts/contentNavbarLayout', ['container' => 'container-md'])

@section('title', 'Account settings - Account')

@section('page-script')
    @vite(['resources/assets/js/account-settings.js'])
@endsection

@section('content')
    @include('_partials.alerts')

    <div class="card mb-6">
        <!-- Account -->
        <div class="card-body">
            <form action="{{ route('account.update.avatar') }}" method="POST" enctype="multipart/form-data"
                class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                @csrf
                <img src="{{ auth()->user()->avatar_url }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                    id="uploadedAvatar" />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new image</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" name="avatar" class="account-file-input" hidden
                            accept="image/png, image/jpeg, image/gif" />
                    </label>
                    <button type="submit" class="btn btn-primary account-image-save me-3 mb-4 d-none">
                        <i class="bx bx-save d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save Image</span>
                    </button>
                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                    </button>

                    <div>Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
            </form>
        </div>
        <div class="card-body pt-4">
            <h4>Account Settings</h4>
            <form action="{{ route('account.update.username') }}" id="formAccountSettings" method="POST"
                class="pb-4 border-bottom">
                @csrf
                <div class="row g-6">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                            name="name" value="{{ old('name') ?? $name }}" placeholder="john.doe" />
                    </div>
                    <div class="col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="select2 form-select @error('role') is-invalid @enderror" disabled>
                            <option value="admin" @selected((old('role') ?? $role) == 'admin')>Admin</option>
                            <option value="user" @selected((old('role') ?? $role) == 'user')>User</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3">Save changes</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>
            </form>
        </div>
        <div class="card-body pt-4">
            <h4>Change Password</h4>
            <form action="{{ route('account.update.password') }}" id="formChangePassword" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input class="form-control @error('current_password') is-invalid @enderror" type="password"
                            id="currentPassword" name="current_password" />
                    </div>
                </div>
                <div class="row g-6 mt-3">
                    <div class="col-md-6">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" id="newPassword"
                            name="password" />
                    </div>
                    <div class="col-md-6">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                            id="confirmPassword" name="password_confirmation" />
                    </div>
                </div>
                <div class="mt-6">
                    <button type="submit" class="btn btn-primary me-3">Change Password</button>
                    <button type="reset" class="btn btn-outline-secondary">Clear</button>
                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
    {{-- <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-6 col-12 mb-0">
                <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check my-8 ms-2">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                    <label class="form-check-label" for="accountActivation">I confirm my account
                        deactivation</label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account" disabled>Deactivate
                    Account</button>
            </form>
        </div>
    </div> --}}
@endsection
