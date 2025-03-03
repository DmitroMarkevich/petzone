@extends('layouts.base')

@section('content')
    <div class="auth-container">
        <div class="auth-left">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/white-logo.svg') }}" alt="Logo">
            </a>
            <div class="image">
                <img src="{{ asset('images/auth/cart.svg') }}" alt="Cart Image">
            </div>
            <p class="tagline">Широкий вибір товарів</p>
        </div>

        <div class="auth-right">
            @yield('auth-content')
        </div>
    </div>
@endsection
