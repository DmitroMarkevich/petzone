@extends('layouts.base')

@section('content')
    <div class="auth-container">
        <div class="auth-left">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="navbar-logo" src="{{ asset('images/white-logo.svg') }}" alt="Logo">
            </a>

            <div class="image-slider">
                <div class="slider-frame">
                    <img id="slider-image" src="{{ asset('images/auth/shopping-cart.png') }}" alt="Slider Image">
                    <p id="slider-text" class="tagline">{{__('auth.slider.shopping_cart')}}</p>
                </div>

                <div class="slider-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </div>

        <div class="auth-right">
            @yield('auth-content')
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.sliderTexts = {!! json_encode([
        'shopping_cart' => __('auth.slider.shopping_cart'),
        'carton' => __('auth.slider.carton'),
        'receipt' => __('auth.slider.receipt'),
    ]) !!};
    </script>

    @vite('resources/js/pages/auth/slider.js')
@endpush


