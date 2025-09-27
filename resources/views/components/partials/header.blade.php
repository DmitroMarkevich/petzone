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
                <div
                    class="category-wrapper"
                    x-data="{ categoryOpen: false, closeTimeout: null }"
                    @mouseenter="clearTimeout(closeTimeout); categoryOpen = true"
                    @mouseleave="closeTimeout = setTimeout(() => categoryOpen = false, 150)"
                >
                    <button class="category-btn" type="button" aria-label="Категорії">
                        <img src="{{ asset('images/header/category.svg') }}" alt="Категорії">Категорії
                    </button>

                    <div class="category-menu" x-show="categoryOpen" x-transition x-cloak>
                        <ul class="category-list">
                            @foreach ($headerCategories as $parent)
                                <li class="category-item" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                    <a href="{{ route('advert.index', ['category' => $parent->slug]) }}"
                                       class="{{ $parent->children->count() ? 'has-children' : '' }}">
                                        {{ $parent->name }}
                                    </a>

                                    @if($parent->children->isNotEmpty())
                                        <ul class="subcategory-list" x-show="open" x-transition x-cloak>
                                            @foreach ($parent->children as $child)
                                                <li>
                                                    <a href="{{ route('advert.index', ['category' => $child->slug]) }}"
                                                       class="{{ $child->children->count() ? 'has-children' : '' }}">
                                                        {{ $child->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
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
                <span class="badge">{{ $wishlistCount }}</span>
            </a>

            <a class="nav-link" href="{{ route('profile.orders.index') }}" aria-label="Cart">
                <img src="{{ asset('images/header/cart.svg') }}" alt="Cart">
                <span class="badge">{{ $ordersCount }}</span>
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

    <aside x-show="sidebarOpen" x-transition class="mobile-sidebar" @click.outside="sidebarOpen = false" x-cloak>
        <div class="sidebar-content">
            <x-partials.profile.sidebar/>
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
        <span class="badge">{{ $wishlistCount }}</span>
    </a>
    <a href="{{ route('advert.create') }}">
        <img src="{{ asset('images/header/add.svg') }}" alt="Add">
        <span>Додати</span>
    </a>
    <a href="{{ route('profile.orders.index') }}">
        <img src="{{ asset('images/header/cart.svg') }}" alt="Cart">
        <span>Кошик</span>
        <span class="badge">{{ $ordersCount }}</span>
    </a>
    <a href="{{ route('profile.index') }}">
        <img src="{{ asset('images/default-avatar.png') }}" alt="Profile">
        <span>Профіль</span>
    </a>
</div>

