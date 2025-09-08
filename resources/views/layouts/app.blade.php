@extends('layouts.base')

@section('content')
    @include('components.partials.header')

    <main>
        @yield('app-content')
        @stack('scripts')
    </main>

    @include('components.partials.footer')
@endsection
