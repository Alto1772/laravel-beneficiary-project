@extends('layouts/contentNavbarLayout', ['container' => 'container-sm'])

@section('title', 'Update Beneficiary | ' . config('variables.templateName'))

@section('page-script')
    <script>
        window.oldBarangayId = {{ old('barangay') ?? $beneficiary->barangay_id }};
        window.oldMunicipalityId = {{ old('municipality') ?? $beneficiary->barangay->municipality_id }};
    </script>
    @vite('resources/assets/js/beneficiary-form.js')
@endsection

@section('content')
    @include('_partials.alerts')

    <div class="card border border-secondary px-md-6">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Update Beneficiary for <b>{{ $beneficiary->name ?? 'unspecified' }}</b></h5>
        </div>
        <div class="card-body">
            <form action="{{ route('beneficiary.update', ['id' => $beneficiary->id]) }}" method="POST">
                @csrf
                <div class="row mb-6" id="personRow">
                    <div class="col">
                        <div class="row g-5">
                            <div class="col-lg-5 col-md-4 col-sm-6">
                                <label class="form-label" for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="lastName"
                                    value="{{ old('last_name') ?? $beneficiary->last_name }}"
                                    class="form-control @error('last_name') is-invalid @enderror" placeholder="Dela Cruz">
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <label class="form-label" for="first_name">First Name</label>
                                <input type="text" name="first_name" id="firstName"
                                    value="{{ old('first_name') ?? $beneficiary->first_name }}"
                                    class="form-control @error('first_name') is-invalid @enderror" placeholder="Juan">
                            </div>
                            <div class="col-lg-1 col-md-2 col-sm-6">
                                <label class="form-label" for="middle_initial">M.I.</label>
                                <input type="text" name="middle_initial" id="middleName"
                                    value="{{ old('middle_initial') ?? $beneficiary->middle_initial }}"
                                    class="form-control @error('middle_initial') is-invalid @enderror" placeholder="H.">
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <label class="form-label" for="age">Age</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror" id="ageInput"
                                    name="age" value="{{ old('age') ?? $beneficiary->age }}" min="1"
                                    placeholder="Enter age" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-6 g-5" id="locationRow">
                    <div class="col-md-6">
                        <label for="municipality" class="form-label">Municipality</label>
                        <select name="municipality" class="form-select @error('municipality') is-invalid @enderror"
                            id="municipalitySelect" disabled>
                            <option selected>-- Select Municipality --</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="barangay">Barangay</label>
                        <select name="barangay" class="form-select @error('barangay') is-invalid @enderror"
                            id="barangaySelect" disabled>
                            <option selected>-- Select Barangay --</option>
                        </select>
                    </div>
                </div>
                <div class="justify-content-start align-items-start">
                    <button type="submit" class="btn btn-primary me-5" id="submitButton" disabled>Submit</button>
                    <a class="btn btn-secondary" href="{{ url()->previous() }}">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
