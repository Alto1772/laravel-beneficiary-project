@extends('layouts/contentNavbarLayout', ['container' => 'container-lg'])

@section('title', 'Historical Data | ' . config('variables.templateName'))

@section('page-script')
    <script>
        window.deleteRouteTemplate = "{{ route('beneficiary.delete', ['id' => ':id']) }}";
    </script>
    @vite('resources/assets/js/beneficiary-index.js')
@endsection

@section('content')
    @include('_partials.alerts')

    <!-- Basic Bootstrap Table -->
    <div class="card border border-primary px-md-6">
        <div class="card-header header-elements justify-content-around gap-3 p-4">
            <!-- Search -->
            <div class="card-header-elements flex-fill">
                @include('_partials.search-bar')
            </div>
            <!-- /Search -->
            <div class="card-header-elements">
                <div class="me-2 d-none d-sm-inline"><span>Select Year:</span></div>
                <div class="me-2">
                    <form action="{{ url()->current() }}" method="GET">
                        <select class="form-select" name="year" id="year" onchange="this.form.submit()">
                            <option value="">All</option>
                            <script>
                                (function() {
                                    yearEl = document.getElementById('year');
                                    selectedYear = {{ $year ?? 'null' }};

                                    const currentYear = new Date().getFullYear();
                                    const yearOptions = Array.from({
                                        length: currentYear - 2019 + 1
                                    }, (_, i) => currentYear - i);
                                    yearOptions.map(year => {
                                        optionEl = document.createElement('option');
                                        optionEl.value = optionEl.text = year;
                                        if (selectedYear === year) optionEl.selected = true;
                                        yearEl.appendChild(optionEl);
                                    });
                                })();
                            </script>
                        </select>
                    </form>
                </div>

                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#uploadFileModal"><i class='bx bx-import'></i> Import Data</a>
                        <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#exportFileModal">
                            <i class='bx bx-export'></i> Export Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Barangay</th>
                        <th>Municipality</th>
                        <th>Age</th>
                        <th>Year added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $beneficiary)
                        <tr>
                            <td><span @class(['text-muted' => $beneficiary->name == null])>{{ $beneficiary->name ?? 'unspecified' }}</span></td>
                            <td><span>{{ $beneficiary->barangay->name }}</span></td>
                            <td><span>{{ $beneficiary->barangay->municipality->name }}</span></td>
                            <td><span>{{ $beneficiary->age }}</span></td>
                            <td><span>{{ $beneficiary->created_at->year }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('beneficiary.edit', ['id' => $beneficiary->id]) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <button type="button" class="dropdown-item" id="deleteEntryButton"
                                            data-id="{{ $beneficiary->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($data->isEmpty())
                <div class="text-center text-muted my-5">No beneficiaries found for the selected criteria.</div>
            @endif
        </div>
        <div class="card-footer">
            @if (!$data->isEmpty())
                {{ $data->links() }}
            @endif
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->


    <!-- Upload Data Modal -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="uploadFileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('historical.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadFileModalLabel">Import Beneficiaries Datasheet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <div class="col">
                                <input class="form-control" type="file" id="formFile" name="dataset">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="year">Year</label>
                            <input class="form-control" type="number" name="year" id="year" min="2019"
                                max="{{ date('Y') }}" value="{{ date('Y') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mx-2"><i class='bx bx-import'></i>
                            Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Export Data Modal -->
    <div class="modal fade" id="exportFileModal" tabindex="-1" aria-labelledby="exportFileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('historical.export') }}" method="get">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exportFileModalLabel">Export Beneficiaries Data to Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label" for="year">Year</label>
                            <input class="form-control" type="number" name="year" id="year" min="2019"
                                max="{{ date('Y') }}" value="{{ date('Y') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mx-2"><i class='bx bx-export'></i>
                            Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Entry Modal -->
    <div class="modal fade" id="deleteEntryModal" tabindex="-1" aria-labelledby="deleteEntryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEntryModalLabel">Delete Beneficiary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this beneficiary?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteEntryForm" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Delete Entry Modal -->
@endsection
