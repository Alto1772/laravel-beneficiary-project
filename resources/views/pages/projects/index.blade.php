@extends('layouts/contentNavbarLayout', ['container' => 'container-lg'])

@section('title', 'Projects | ' . config('variables.templateName'))

@section('page-script')
    <script>
        window.deleteRouteTemplate = "{{ route('projects.destroy', ['project' => ':id']) }}";
        window.deleteAllRouteTemplate = "{{ route('projects.deleteAll', ['project' => ':id']) }}";
    </script>
    @vite('resources/assets/js/projects-index.js')
@endsection

@section('content')
    @include('_partials.alerts')

    <!-- Basic Bootstrap Table -->
    <div class="card border border-primary px-md-6">
        <div class="card-header header-elements justify-content-around gap-3 p-4">
            <h5 class="mb-0 me-2 flex-grow">ALL PROJECTS</h5>
            <div class="card-header-elements flex-fill">
                @include('_partials.search-bar')
            </div>
            <div class="card-header-elements">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{ route('projects.create') }}"><i class='bx bx-list-plus'></i>
                            Add Project</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td><a
                                    href="{{ route('beneficiary.index', ['project_id' => $project->id]) }}">{{ $project->name }}</a>
                            </td>
                            <td>{{ $project->location }}</td>
                            <td>{{ $project->beneficiaries_count }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('projects.edit', ['project' => $project]) }}">
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <button type="button" class="dropdown-item" id="deleteEntryButton"
                                            data-id="{{ $project->id }}">
                                            <i class="bx bx-trash me-1"></i> Delete Project
                                        </button>
                                        <a href="{{ route('beneficiary.index', ['project_id' => $project->id]) }}"
                                            class="dropdown-item">
                                            <i class="bx bx-gift me-1"></i>
                                            View Beneficiaries
                                        </a>
                                        <a href="{{ route('projects.export', ['project' => $project]) }}"
                                            class="dropdown-item">
                                            <i class="bx bx-export me-1"></i>
                                            Export Beneficiaries
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($projects->isEmpty())
                <div class="text-center text-muted my-5">No projects found for the selected criteria.</div>
            @endif
        </div>
        <div class="card-footer">
            @if (!$projects->isEmpty())
                {{ $projects->links() }}
            @endif
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <!-- Delete Entry Modal -->
    <div class="modal fade" id="deleteEntryModal" tabindex="-1" aria-labelledby="deleteEntryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEntryModalLabel">Delete Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this project?
                </div>
                <div class="modal-footer">
                    <form id="deleteEntryForm" method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" id="deleteButton" class="btn btn-danger me-3">Delete Project</button>
                        <button type="button" id="deleteAllButton" class="btn btn-warning me-3">Delete All</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Delete Entry Modal -->
@endsection
