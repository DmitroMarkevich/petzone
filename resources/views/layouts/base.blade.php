<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'PetZone') }}
        @hasSection('title') — @yield('title') @endif
    </title>

    <script src="https://unpkg.com/alpinejs" defer></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>
<body data-route="{{ Route::currentRouteName() }}" x-data="{ sidebarOpen: false }">
    <div id="global-loader-overlay" class="hidden"></div>
    @yield('content')
    @stack('scripts')
</body>
</html>
