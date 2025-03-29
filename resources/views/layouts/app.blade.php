@extends('layouts.base')

@section('content')
    @include('partials.header')

    <main>
        @yield('app-content')
        @stack('scripts')
    </main>

    @include('partials.footer')
@endsection
