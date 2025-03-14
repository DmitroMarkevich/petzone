@extends('layouts.base')

@section('content')
    <header class="header">
        <div class="page-container">
            <nav class="navbar">
                <a href="{{ route('home') }}" class="logo-container">
                    <img src="{{ asset('images/blue-logo.svg') }}" alt="PetZone Logo" class="logo">
                </a>

                <div class="navbar-center">
                    <form class="search-form" action="{{ route('adverts.search') }}" method="GET">
                        <div class="input-group">
                            <button class="category-btn" type="button" aria-label="Категорії" id="categoryToggle">
                                <img src="{{ asset('images/header/category.svg') }}" alt="Категорії"
                                     class="category-icon">
                                Категорії
                            </button>

                            <div class="category-menu" id="categoryMenu">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/header/category/dog.svg') }}" alt="Собака"
                                                 class="category-image">
                                            Для Собак
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="{{ asset('images/header/category/cat.svg') }}" alt="Кіт"
                                                 class="category-image">
                                            Для Котів
                                        </a>
                                    </li>
                                    <li><a href="#">Для Гризунів</a></li>
                                    <li><a href="#">Для Птахів</a></li>
                                    <li><a href="#">Для Риб</a></li>
                                    <li><a href="#">Для Рептилій</a></li>
                                    <li><a href="#">Загальні Товари</a></li>
                                    <li><a href="#">Інші Товари</a></li>
                                </ul>
                            </div>

                            <input class="search-input" type="search" name="query" placeholder="Я шукаю..."
                                   aria-label="Search" value="{{ request('query') }}">
                            <button class="search-btn" type="submit" aria-label="Search">
                                <img src="{{ asset('images/header/search.svg') }}" alt="Search">
                            </button>
                        </div>
                    </form>
                </div>

                <div class="navbar-right">
                    <a class="nav-link" href="{{ route('profile.wishlist') }}" aria-label="Wishlist">
                        <img src="{{ asset('images/header/heart.svg') }}" alt="Wishlist" class="icon-heart">
                        <span class="badge">{{ session('wishlist') ? count(session('wishlist')) : 0 }}</span>
                    </a>
                    <a class="nav-link" href="{{ route('profile.orders') }}" aria-label="Cart">
                        <img src="{{ asset('images/header/cart.svg') }}" alt="Cart" class="icon-cart">
                        <span class="badge">{{ auth()->user()->orders()->count() }}</span>
                    </a>
                    <a class="nav-avatar" href="{{ route('profile.index') }}">
                        @if (auth()->user() && !empty(auth()->user()->image_path))
                            <img src="{{ Storage::disk('s3')->url(auth()->user()->image_path) }}" alt="User Avatar"
                                 class="nav-avatar-image">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar"
                                 class="nav-avatar-image">
                        @endif
                    </a>
                    <a href="{{ route('adverts.create') }}" class="hero-button">Додати оголошення</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('app-content')
    </main>

    <footer class="footer">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/white-logo.svg') }}" alt="Logo">
        </a>
        <ul class="footer-links">
            <li class="footer-link-item"><a href="">Про нас</a></li>
            <li class="footer-link-item"><a href="">Правила та умови</a></li>
            <li class="footer-link-item"><a href="">Політика конфіденційності</a></li>
        </ul>
        <p class="footer-copy">PetZone © 2024 Всі права захищені</p>
    </footer>

    <script>
        $(document).ready(function () {
            const categoryBtn = $("#categoryToggle");
            const categoryMenu = $("#categoryMenu");

            categoryBtn.on("click", function (event) {
                event.stopPropagation();
                categoryMenu.toggleClass("active");
            });

            $(document).on("click", function (event) {
                if (!categoryMenu.is(event.target) && !categoryBtn.is(event.target) && categoryMenu.has(event.target).length === 0) {
                    categoryMenu.removeClass("active");
                }
            });
        });
    </script>
@endsection
