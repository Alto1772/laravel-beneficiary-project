<!-- BEGIN: Theme CSS-->
<!-- Fonts -->
@vite('webfonts.css')

@vite(['resources/assets/vendor/fonts/boxicons.scss'])

<!-- Core CSS -->
@vite([
    'resources/assets/vendor/scss/core.scss',
    'resources/assets/vendor/scss/theme-default.scss',
    // 'resources/assets/css/demo.css'
])

<!-- Vendor Styles -->
@vite(['resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss'])
@yield('vendor-style')

<!-- Page Styles -->
@yield('page-style')
