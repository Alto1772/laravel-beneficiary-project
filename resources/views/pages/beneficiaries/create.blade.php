@extends('layouts/contentNavbarLayout', ['container' => 'container-sm'])

@section('title', 'Add New Beneficiary | ' . config('variables.templateName'))

@section('page-script')
    <script>
        window.oldBarangayId = {{ old('barangay') ?? 'null' }};
        window.oldMunicipalityId = {{ old('municipality') ?? 'null' }};
    </script>
    @vite('resources/assets/js/beneficiary-form.js')
@endsection

@section('content')
    @include('_partials.alerts')

    <div class="card border border-secondary px-md-6">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add Beneficiary</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('beneficiary.add') }}" method="POST">
                @csrf
                <div class="row mb-6" id="nameRow">
                    <label class="col-sm-3 col-md-2 col-form-label" for="nameInput">Name</label>
                    <div class="col-sm-9 col-md-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
                            name="name" value="{{ old('name') ?? '' }}" placeholder="Juan Dela Cruz" />
                    </div>
                </div>
                <div class="row mb-6" id="ageRow">
                    <label class="col-sm-3 col-md-2 col-form-label" for="ageInput">Age</label>
                    <div class="col-sm-9 col-md-10">
                        <input type="number" class="form-control @error('age') is-invalid @enderror" id="ageInput"
                            name="age" value="{{ old('age') ?? '' }}" min="1" placeholder="Enter age" />
                    </div>
                </div>
                <div class="row mb-6" id="municipalityRow">
                    <label class="col-sm-3 col-md-2 col-form-label" for="municipalitySelect">Municipality</label>
                    <div class="col-sm-9 col-md-10">
                        <select name="municipality" class="form-select @error('municipality') is-invalid @enderror"
                            id="municipalitySelect" disabled>
                            <option selected>-- Select Municipality --</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-6 d-none" id="barangayRow">
                    <label class="col-sm-3 col-md-2 col-form-label" for="barangaySelect">Barangay</label>
                    <div class="col-sm-9 col-md-10">
                        <select name="barangay" class="form-select @error('barangay') is-invalid @enderror"
                            id="barangaySelect" disabled>
                            <option selected>-- Select Barangay --</option>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-end align-items-start">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary me-5" id="submitButton" disabled>Submit</button>
                        <a class="btn btn-secondary" href="{{ route('beneficiary.index') }}">Go Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
