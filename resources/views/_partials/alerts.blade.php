@if (session()->has('success'))
    <!-- Success Alert -->
    <div class="alert alert-success alert-dismissible d-flex mb-4" role="alert">
        <span class="alert-icon rounded-circle"><i class="bx bx-check"></i></span>
        <div class="d-flex flex-column ps-1">
            {{-- <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Success</h6> --}}
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif

@if ($errors->any())
    <!-- Error Alert -->
    <div class="alert alert-danger alert-dismissible d-flex mb-4" role="alert">
        <span class="alert-icon rounded-circle">!</span>
        <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Error!!!</h6>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif
