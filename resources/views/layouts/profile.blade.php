@extends('layouts.app')

@section('title', 'Мій профіль')

@section('app-content')
    <div class="page-container">
        <div class="profile-template">
            <div class="profile-sidebar">
                <div class="profile-item">
                    <a class="profile-link {{ is_active('profile') }}" href="{{ route('profile.index') }}">
                        <img src="{{ asset('images/profile/profile.svg') }}" alt="Профіль">Профіль
                    </a>
                </div>

                <div class="profile-item">
                    <a class="profile-link {{ is_active('profile/orders') }}" href="{{ route('profile.orders.index') }}">
                        <img src="{{ asset('images/profile/cart.svg') }}" alt="Замовлення">Замовлення
                    </a>
                </div>

                <div class="profile-item">
                    <a class="profile-link {{ is_active('profile/adverts') }}" href="{{ route('profile.adverts') }}">
                        <img src="{{ asset('images/profile/folder.svg') }}" alt="Оголошення">Мої оголошення
                    </a>
                </div>

                <div class="profile-item">
                    <a class="profile-link {{ is_active('profile/wishlist') }}" href="{{ route('profile.wishlist') }}">
                        <img src="{{ asset('images/profile/heart.svg') }}" alt="Вподобання">Вподобання
                    </a>
                </div>

                <div class="profile-item">
                    <a class="profile-link {{ is_active('profile/sales') }}"
                       href="{{ route('profile.sales.index') }}">
                        <img src="{{ asset('images/profile/chart.svg') }}" alt="Продажі">Мої продажі
                    </a>
                </div>

                <div class="profile-item">
                    <a class="profile-link {{ is_active('profile/orders/history') }}"
                       href="{{ route('profile.orders.history') }}">
                        <img src="{{ asset('images/profile/notebook.svg') }}" alt="Історія">Історія замовлень
                    </a>
                </div>

                <div class="profile-item">
                    <a class="profile-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset('images/profile/logout.svg') }}" alt="Вийти">Вийти
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
