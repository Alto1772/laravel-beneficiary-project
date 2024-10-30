@extends('layouts/contentNavbarLayout', ['container' => 'container-lg'])

@section('title', 'Barangay Table | ' . config('variables.templateName'))

@section('content')
    @include('_partials.alerts')

    <!-- Basic Bootstrap Table -->
    <div class="card border border-primary px-md-6">
        <div class="card-header header-elements justify-content-between p-4">
            <h5 class="mb-0 me-2">SUMMARY OF BENEFICIARIES BY BARANGAY</h5>
            <div class="card-header-elements">
                {{-- <div class="me-2">
                    <form action="{{ url()->current() }}" method="GET">
                        <select class="form-select" name="year" id="year" onchange="this.form.submit()">
                            @foreach (range(date('Y'), 2000) as $yi)
                                <option value="{{ $yi }}" @selected($year == $yi)>
                                    {{ $yi }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div> --}}
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Barangay</th>
                        <th>No. of Beneficiaries</th>
                        <th>Age Range</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $barangay)
                        <tr>
                            <td><span>{{ $data->firstItem() + $loop->index }}</span></td>
                            <td><a href="{{ route('beneficiary.index', ['barangay' => $barangay->name]) }}">
                                    <span>{{ $barangay->name }}</span>
                                </a></td>
                            <td><span>{{ $barangay->beneficiaries_count }}</span></td>
                            <td><span>{{ $barangay->beneficiaries_min_age }}-{{ $barangay->beneficiaries_max_age }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($data->isEmpty())
                <div class="text-center text-muted my-5">No records available.</div>
            @endif
        </div>
        <div class="card-footer">
            @if (!$data->isEmpty())
                {{ $data->links() }}
            @endif
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
