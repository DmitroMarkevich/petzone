<header class="page-container">
    <nav class="navbar">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/blue-logo.svg') }}" alt="Logo" class="logo">
        </a>

        <form action="{{ route('adverts.index') }}" method="GET">
            <div class="input-group">
                <button class="category-btn" type="button" aria-label="Категорії" id="categoryToggle">
                    <img src="{{ asset('images/header/category.svg') }}" alt="Категорії" class="category-icon">
                    Категорії
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
                <img src="{{ asset('images/header/heart.svg') }}" alt="Wishlist" class="icon-heart">
                <span class="badge">{{ auth()->user()->wishlist()->count() }}</span>
            </a>

            <a class="nav-link" href="{{ route('profile.orders.index') }}" aria-label="Cart">
                <img src="{{ asset('images/header/cart.svg') }}" alt="Cart" class="icon-cart">
                <span class="badge">{{ auth()->user()->orders()->count() }}</span>
            </a>

            <a class="nav-avatar" href="{{ route('profile.index') }}">
                @if (!empty(auth()->user()->image_path))
                    <img src="{{ Storage::disk('s3')->url(auth()->user()->image_path) }}" alt="Avatar"
                         class="nav-avatar-image">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="nav-avatar-image">
                @endif
            </a>

            <a href="{{ route('adverts.create') }}" class="hero-button">Додати оголошення</a>
        </div>
    </nav>
</header>
