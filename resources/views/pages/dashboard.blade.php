@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-style')
    @vite('resources/assets/css/dashboard.css')
@endsection

@section('page-script')
    @vite('resources/assets/js/dashboard-age-barangay.js')
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-6 col-lg-7 mb-4 graph-container">
            <div class="card">
                <div class="card-header d-flex align-items-start justify-content-between mb-4">
                    <h5 class="card-title">Age Statistics</h5>

                    {{-- <div class="card-header-elements">
                        <select class="form-select form-select-sm" id="ageYear">
                            <option value="">All</option>
                            <script>
                                (function() {
                                    yearEl = document.getElementById('ageYear');

                                    // add date option generator here and replace below
                                    const currentYear = new Date().getFullYear();
                                    const yearOptions = Array.from({
                                        length: currentYear - 2000 + 1
                                    }, (_, i) => currentYear - i);
                                    yearOptions.map(year => {
                                        optionEl = document.createElement('option');
                                        optionEl.value = optionEl.text = year;
                                        yearEl.appendChild(optionEl);
                                    });
                                })();
                            </script>
                        </select>
                    </div> --}}
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);" id="expandGraphButton"><i
                                    class="bx bx-expand-horizontal"></i>
                                Expand Graph</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="ageChart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-5 mb-4 graph-container order-2">
            <div class="card">
                <div class="card-header d-flex align-items-start justify-content-between mb-4">
                    <h5 class="card-title">Barangay Statistics</h5>
                    {{-- <div class="card-header-elements">
                        <select class="form-select form-select-sm" id="barangayYear">
                            <option value="">All</option>
                            <script>
                                (function() {
                                    yearEl = document.getElementById('barangayYear');

                                    // add date option generator here and replace below
                                    const currentYear = new Date().getFullYear();
                                    const yearOptions = Array.from({
                                        length: currentYear - 2000 + 1
                                    }, (_, i) => currentYear - i);
                                    yearOptions.map(year => {
                                        optionEl = document.createElement('option');
                                        optionEl.value = optionEl.text = year;
                                        yearEl.appendChild(optionEl);
                                    });
                                })();
                            </script>
                        </select>
                    </div> --}}
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                            <a class="dropdown-item" href="javascript:void(0);" id="expandGraphButton"><i
                                    class="bx bx-expand-horizontal"></i>
                                Expand graph</a>
                            <a class="dropdown-item" href="{{ route('barangay.index') }}"><i
                                    class="bx bx-building-house"></i> Go to Barangays List</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="barangayChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
