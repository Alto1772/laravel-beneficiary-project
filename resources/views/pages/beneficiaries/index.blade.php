@extends('layouts/contentNavbarLayout', ['container' => 'container-lg'])

@section('title', 'Beneficiaries Table | ' . config('variables.templateName'))

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
            <h5 class="mb-0 me-2 flex-grow">{{ \Carbon\Carbon::now()->year }} TUPAD BENEFICIARIES</h5>
            <div class="card-header-elements flex-fill">
                @include('_partials.search-bar')
            </div>
            <div class="card-header-elements">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{ route('beneficiary.create') }}"><i class='bx bx-list-plus'></i>
                            Add Beneficiary</a>
                        <a class="dropdown-item" href="{{ route('historical.index') }}"><i class='bx bx-history'></i> Go
                            to Historical Data</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Barangay</th>
                        <th>Municipality</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $beneficiary)
                        <tr>
                            <td><span>{{ $data->firstItem() + $loop->index }}</span></td>
                            <td><span @class(['text-muted' => $beneficiary->name == null])
                                    id="editableName">{{ $beneficiary->name ?? 'unspecified' }}</span>
                                {{-- <a href="#" class="text-black-50" id="editNameButton"
                                    data-id="{{ $beneficiary->id }}"><i class="bx bxs-edit"></i></a> --}}
                            </td>
                            <td><span>{{ $beneficiary->barangay->name }}</span></td>
                            <td><span>{{ $beneficiary->barangay->municipality->name }}</span></td>
                            <td><span>{{ $beneficiary->age }}</span></td>
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

    <!-- Delete Entry Modal -->
    <div class="modal fade" id="deleteEntryModal" tabindex="-1" aria-labelledby="deleteEntryModalLabel" aria-hidden="true">
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
