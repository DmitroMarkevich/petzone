@extends('layouts.base')

@section('content')
    <div class="auth-container">
        <div class="auth-left">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="navbar-logo" src="{{ asset('images/white-logo.svg') }}" alt="Logo">
            </a>

            <div class="image-slider"
                 x-data="{
                    currentIndex: 0,
                    sliderImages: [
                        { src: '/images/auth/shopping-cart.png', text: '{{ __('auth.slider.shopping_cart') }}' },
                        { src: '/images/auth/carton.png', text: '{{ __('auth.slider.carton') }}' },
                        { src: '/images/auth/receipt.png', text: '{{ __('auth.slider.receipt') }}' }
                    ],
                    init() {
                        setInterval(() => {
                            this.currentIndex = (this.currentIndex + 1) % this.sliderImages.length;
                        }, 5000);
                    }
                 }"
            >
                <div class="slider-frame">
                    <img
                        src="{{ asset('/images/auth/shopping-cart.png') }}"
                        :src="sliderImages[currentIndex].src"
                        alt="Slider Image"
                        class="slider-image">

                    <p class="tagline" x-text="sliderImages[currentIndex].text"></p>
                </div>

                <div class="slider-dots">
                    <template x-for="(image, index) in sliderImages" :key="index">
                        <span class="dot" :class="{ 'active': currentIndex === index }"></span>
                    </template>
                </div>
            </div>
        </div>

        <div class="auth-right">
            @yield('auth-content')
        </div>
    </div>
@endsection
