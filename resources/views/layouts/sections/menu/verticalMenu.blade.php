<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <!-- ! Hide app brand if navbar-full -->
    <div class="app-brand">
        <a href="{{ url('/') }}" class="app-brand-link">
            <span class="app-brand-logo"><img src="{{ asset('assets/img/icons/brands/DOLE.svg') }}" alt="DOLE logo"
                    height="64px"></span>
            <span class="app-brand-text menu-text fw-bold ms-2">{{ config('variables.templateName') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @foreach ($menuData[0]->menu as $menu)
            {{-- adding active and open class if child is active --}}

            @isset($menu->authType)
                @auth
                    @continue ($menu->authType != 'user' && $menu->authType != 'admin')

                    @continue ($menu->authType == 'admin' && Auth::user()->role != 'admin')
                @endauth
                @guest
                    @continue ($menu->authType != 'guest')
                @endguest
            @endisset

            {{-- menu headers --}}
            @if (isset($menu->menuHeader))
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
                </li>
            @else
                {{-- active menu method --}}
                @php
                    $activeClass = null;
                    $currentRouteName = Route::currentRouteName();

                    if ($currentRouteName === $menu->slug) {
                        $activeClass = 'active';
                    } elseif (isset($menu->submenu)) {
                        if (gettype($menu->slug) === 'array') {
                            foreach ($menu->slug as $slug) {
                                if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                    $activeClass = 'active open';
                                }
                            }
                        } else {
                            if (
                                str_contains($currentRouteName, $menu->slug) and
                                strpos($currentRouteName, $menu->slug) === 0
                            ) {
                                $activeClass = 'active open';
                            }
                        }
                    }
                @endphp

                {{-- main menu --}}
                <li class="menu-item {{ $activeClass }}">
                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}"
                        class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                        @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif
                        @if (isset($menu->request) && $menu->request == 'post') onclick="event.preventDefault();
                              document.getElementById('hidden-form-{{ $loop->index }}').submit()" @endif>
                        @isset($menu->icon)
                            <i class="{{ $menu->icon }}"></i>
                        @endisset
                        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
                        @isset($menu->badge)
                            <div class="badge rounded-pill bg-{{ $menu->badge[0] }} text-uppercase ms-auto">
                                {{ $menu->badge[1] }}</div>
                        @endisset
                    </a>

                    @if (isset($menu->request) && $menu->request == 'post')
                        <form id="hidden-form-{{ $loop->index }}" action="{{ url($menu->url) }}" method="POST"
                            class="d-none">
                            @csrf
                        </form>
                    @endif

                    {{-- submenu --}}
                    @isset($menu->submenu)
                        @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
                    @endisset
                </li>
            @endif
        @endforeach
    </ul>

</aside>
