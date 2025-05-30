@extends('layouts/contentNavbarLayout', ['container' => 'container-sm'])

@section('title', 'Add New Project | ' . config('variables.templateName'))

@section('content')
    @include('_partials.alerts')

    <div class="card border border-secondary px-md-6">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Add Project</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-6">
                    <label class="col-sm-3 col-md-2 col-form-label" for="nameInput">Project Name</label>
                    <div class="col-sm-9 col-md-10">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
                            name="name" value="{{ old('name') ?? '' }}" placeholder="Untitled Project" />
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-sm-3 col-md-2 col-form-label" for="location">Location</label>
                    <div class="col-sm-9 col-md-10">
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                            name="location" value="{{ old('location') ?? '' }}" />
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-sm-3 col-md-2 col-form-label" for="year">Year</label>
                    <div class="col-sm-9 col-md-10">
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year"
                            name="year" value="{{ old('year') ?? date('Y') }}" min="2019" max={{ date('Y') }}>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="col-sm-3 col-md-2 col-form-label" for="datafile">File to import</label>
                    <div class="col-sm-9 col-md-10"><input type="file" class="form-control" id="dataFile"
                            name="datafile"></div>
                </div>
                <div class="row justify-content-end align-items-start">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary me-5" id="submitButton">Submit</button>
                        <a class="btn btn-secondary" href="{{ url()->previous() }}">Go Back</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
