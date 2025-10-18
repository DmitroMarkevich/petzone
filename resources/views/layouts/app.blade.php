@extends('layouts.base')

@section('content')
    @include('components.partials.header')

    <main>
        @yield('app-content')
        @stack('scripts')
    </main>

    @if(session('success'))
        <x-ui.flash-message :message="session('success')"/>
    @elseif(session('warning'))
        <x-ui.flash-message :message="session('warning')" type="warning"/>
    @elseif(session('error'))
        <x-ui.flash-message :message="session('error')" type="error"/>
    @endif

    @include('components.partials.footer')
@endsection
