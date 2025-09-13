<header class="page-container" x-data="{ sidebarOpen: false, categoryOpen: false, searchOpen: false }">
    <nav class="navbar" :class="{ 'profile-page': $el.closest('.profile-template') }">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/blue-logo.svg') }}" alt="Logo">
        </a>

        <button class="search-btn-mobile" @click="searchOpen = true" aria-label="Search">
            <img src="{{ asset('images/header/search.svg') }}" alt="Search">
        </button>

        @if (request()->is('profile*'))
            <button class="hamburger" @click="sidebarOpen = !sidebarOpen" aria-label="Меню">
                <span></span>
                <span></span>
                <span></span>
            </button>
        @endif

        <form action="{{ route('advert.index') }}" method="GET">
            <div class="input-group">
                <button class="category-btn" type="button" aria-label="Категорії" id="categoryToggle">
                    <img src="{{ asset('images/header/category.svg') }}" alt="Категорії">Категорії
                </button>

                <div class="category-menu" id="categoryMenu">
                    <ul>
                        <li><a href="#">Для Собак</a></li>
                        <li><a href="#">Для Котів</a></li>
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

        <div class="navbar-right">
            <a class="nav-link" href="{{ route('profile.wishlist') }}" aria-label="Wishlist">
                <img src="{{ asset('images/header/heart.svg') }}" alt="Wishlist">
                <span class="badge">{{ auth()->user()->wishlist()->count() }}</span>
            </a>

            <a class="nav-link" href="{{ route('profile.orders.index') }}" aria-label="Cart">
                <img src="{{ asset('images/header/cart.svg') }}" alt="Cart">
                <span class="badge">{{ auth()->user()->orders()->count() }}</span>
            </a>

            <a class="nav-avatar" href="{{ route('profile.index') }}">
                @if (!empty(auth()->user()->image_path))
                    <img src="{{ image_url(auth()->user()->image_path) }}" alt="Avatar" class="nav-avatar-image">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="nav-avatar-image">
                @endif
            </a>

            <a href="{{ route('advert.create') }}" class="hero-button">Додати оголошення</a>
        </div>

        <div x-show="searchOpen" x-transition class="mobile-search-modal" @click.outside="searchOpen = false" x-cloak>
            <div class="modal-content">
                <form action="{{ route('advert.index') }}" method="GET">
                    <input type="text" name="query" placeholder="Що шукаєте?" autofocus class="modal-search-input">
                    <button type="submit" class="modal-search-btn">Пошук</button>
                </form>
                <button @click="searchOpen = false" class="modal-close-btn">&times;</button>
            </div>
        </div>
    </nav>

    <aside x-show="sidebarOpen"
           x-transition
           class="mobile-sidebar"
           @click.outside="sidebarOpen = false"
           x-cloak>
        <div class="sidebar-content">
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
                <a class="profile-link {{ is_active('profile/advert') }}" href="{{ route('profile.advert') }}">
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
    </aside>
</header>

<div class="mobile-footer">
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/header/home.svg') }}" alt="Home">
        <span>Головна</span>
    </a>
    <a href="{{ route('profile.wishlist') }}">
        <img src="{{ asset('images/header/heart.svg') }}" alt="Wishlist">
        <span>Улюблене</span>
        <span class="badge">{{ auth()->user()->wishlist()->count() }}</span>
    </a>
    <a href="{{ route('advert.create') }}">
        <img src="{{ asset('images/header/add.svg') }}" alt="Add">
        <span>Додати</span>
    </a>
    <a href="{{ route('profile.orders.index') }}">
        <img src="{{ asset('images/header/cart.svg') }}" alt="Cart">
        <span>Кошик</span>
        <span class="badge">{{ auth()->user()->orders()->count() }}</span>
    </a>
    <a href="{{ route('profile.index') }}">
        <img src="{{ asset('images/default-avatar.png') }}" alt="Profile">
        <span>Профіль</span>
    </a>
</div>

