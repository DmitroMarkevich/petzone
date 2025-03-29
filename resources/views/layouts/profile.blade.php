@extends('layouts.app')

@section('title', 'Мій профіль')

@section('app-content')
    <div class="page-container">
        <div class="profile-template">
            <div class="profile-sidebar">
                <div class="profile-navigation-item">
                    <a class="profile-navigation-link {{ request()->is('profile') ? 'active' : '' }}"
                       href="{{ route('profile.index') }}">
                        <img src="{{ asset('images/profile/profile.svg') }}" alt="Профіль" class="profile-icon">
                        Профіль
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link {{ request()->is('profile/orders') ? 'active' : '' }}"
                       href="{{ route('profile.orders') }}">
                        <img src="{{ asset('images/profile/cart.svg') }}" alt="Замовлення" class="profile-icon">
                        Замовлення
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link {{ request()->is('profile/adverts') ? 'active' : '' }}"
                       href="{{ route('profile.adverts') }}">
                        <img src="{{ asset('images/profile/folder.svg') }}" alt="Оголошення" class="profile-icon">
                        Мої оголошення
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link {{ request()->is('profile/wishlist') ? 'active' : '' }}"
                       href="{{ route('profile.wishlist') }}">
                        <img src="{{ asset('images/profile/heart.svg') }}" alt="Вподобання" class="profile-icon">
                        Вподобання
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link {{ request()->is('profile/orders-history') ? 'active' : '' }}"
                       href="{{ route('profile.orders-history') }}">
                        <img src="{{ asset('images/profile/notebook.svg') }}" alt="Історія" class="profile-icon">
                        Історія замовлень
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset('images/profile/logout.svg') }}" alt="Вийти" class="profile-icon">Вийти
                        <form action="{{ route('logout') }}" id="logout-form" method="POST">
                            @csrf
                        </form>
                    </a>
                </div>
            </div>

            <div class="profile-content">
                @yield('profile-content')
            </div>
        </div>
    </div>
@endsection
