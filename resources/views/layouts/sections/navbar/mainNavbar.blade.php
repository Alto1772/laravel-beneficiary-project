@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    $containerNav = $containerNav ?? 'container-fluid';
    $navbarDetached = $navbarDetached ?? '';
@endphp

<!-- Navbar -->
@if (isset($navbarDetached) && $navbarDetached == 'navbar-detached')
    <nav class="layout-navbar {{ $containerNav }} navbar navbar-expand-xl {{ $navbarDetached }} align-items-center bg-navbar-theme"
        id="layout-navbar">
@endif
@if (isset($navbarDetached) && $navbarDetached == '')
    <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="{{ $containerNav }}">
@endif

<!--  Brand demo (display only for navbar-full and hide on below xl) -->
@if (isset($navbarFull))
    <div class="navbar-brand app-brand d-none d-xl-flex py-0 me-4">
        <a href="{{ url('/') }}" class="app-brand-link gap-2">
            <span class="app-brand-logo"><img src="{{ asset('assets/img/icons/brands/DOLE.svg') }}" alt="DOLE logo"
                    height="32px"></span>
            <span class="app-brand-text menu-text fw-bold text-heading">{{ config('variables.templateName') }}</span>
        </a>
    </div>
@endif

<!-- TODO responsive navbar -->

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

        @foreach ($navData[0]->menu as $menu)
            @php
                $activeClass = null;
                $currentRouteName = Route::currentRouteName();

                if ($currentRouteName === $menu->slug) {
                    $activeClass = 'active';
                } elseif (isset($menu->submenu)) {
                    if (gettype($menu->slug) === 'array') {
                        foreach ($menu->slug as $slug) {
                            if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                $activeClass = 'active';
                            }
                        }
                    } else {
                        if (
                            str_contains($currentRouteName, $menu->slug) and
                            strpos($currentRouteName, $menu->slug) === 0
                        ) {
                            $activeClass = 'active';
                        }
                    }
                }
            @endphp

            {{-- main menu --}}
            <li class="nav-item ms-2">
                <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                    class="{{ isset($menu->submenu) ? 'nav-link menu-toggle' : 'nav-link' }} {{ $activeClass }}"
                    @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
                    <span class="fs-5">{{ isset($menu->name) ? __($menu->name) : '' }}</span>
                </a>

                {{-- submenu --}}
                {{-- @isset($menu->submenu)
                        @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
                    @endisset --}}
            </li>
        @endforeach
        {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="javascript:void(0)">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Link</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="javascript:void(0)">Action</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Another action</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0)">Something else here</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="javascript:void(0)" tabindex="-1">Disabled</a>
        </li> --}}
    </ul>
</div>
{{-- <ul class="navbar-nav flex-row align-items-center ms-auto">
    <li>
        <a href="{{ route('dashboard.index') }}" class="btn btn-primary" target="_blank">
            <span class="tf-icons bx bxs-dashboard me-md-1"></span>
            <span class="d-none d-md-block">Admin Dashboard</span>
        </a>
    </li>
</ul> --}}

@if (!isset($navbarDetached))
    </div>
@endif
</nav>
