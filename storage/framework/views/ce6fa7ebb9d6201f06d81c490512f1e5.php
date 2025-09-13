<header class="page-container" x-data="{ sidebarOpen: false, categoryOpen: false, searchOpen: false }">
    <nav class="navbar" :class="{ 'profile-page': $el.closest('.profile-template') }">
        <a href="<?php echo e(route('home')); ?>" class="logo">
            <img src="<?php echo e(asset('images/blue-logo.svg')); ?>" alt="Logo">
        </a>

        <button class="search-btn-mobile" @click="searchOpen = true" aria-label="Search">
            <img src="<?php echo e(asset('images/header/search.svg')); ?>" alt="Search">
        </button>

        <?php if(request()->is('profile*')): ?>
            <button class="hamburger" @click="sidebarOpen = !sidebarOpen" aria-label="Меню">
                <span></span>
                <span></span>
                <span></span>
            </button>
        <?php endif; ?>

        <form action="<?php echo e(route('advert.index')); ?>" method="GET">
            <div class="input-group">
                <button class="category-btn" type="button" aria-label="Категорії" id="categoryToggle">
                    <img src="<?php echo e(asset('images/header/category.svg')); ?>" alt="Категорії">Категорії
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
                       aria-label="Search" value="<?php echo e(request('query')); ?>">
                <button class="search-btn" type="submit" aria-label="Search">
                    <img src="<?php echo e(asset('images/header/search.svg')); ?>" alt="Search">
                </button>
            </div>
        </form>

        <div class="navbar-right">
            <a class="nav-link" href="<?php echo e(route('profile.wishlist')); ?>" aria-label="Wishlist">
                <img src="<?php echo e(asset('images/header/heart.svg')); ?>" alt="Wishlist">
                <span class="badge"><?php echo e($wishlistCount); ?></span>
            </a>

            <a class="nav-link" href="<?php echo e(route('profile.orders.index')); ?>" aria-label="Cart">
                <img src="<?php echo e(asset('images/header/cart.svg')); ?>" alt="Cart">
                <span class="badge"><?php echo e($ordersCount); ?></span>
            </a>

            <a class="nav-avatar" href="<?php echo e(route('profile.index')); ?>">
                <?php if(!empty(auth()->user()->image_path)): ?>
                    <img src="<?php echo e(image_url(auth()->user()->image_path)); ?>" alt="Avatar" class="nav-avatar-image">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Avatar" class="nav-avatar-image">
                <?php endif; ?>
            </a>

            <a href="<?php echo e(route('advert.create')); ?>" class="hero-button">Додати оголошення</a>
        </div>

        <div x-show="searchOpen" x-transition class="mobile-search-modal" @click.outside="searchOpen = false" x-cloak>
            <div class="modal-content">
                <form action="<?php echo e(route('advert.index')); ?>" method="GET">
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
                <a class="profile-link <?php echo e(is_active('profile')); ?>" href="<?php echo e(route('profile.index')); ?>">
                    <img src="<?php echo e(asset('images/profile/profile.svg')); ?>" alt="Профіль">Профіль
                </a>
            </div>

            <div class="profile-item">
                <a class="profile-link <?php echo e(is_active('profile/orders')); ?>" href="<?php echo e(route('profile.orders.index')); ?>">
                    <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Замовлення">Замовлення
                </a>
            </div>

            <div class="profile-item">
                <a class="profile-link <?php echo e(is_active('profile/advert')); ?>" href="<?php echo e(route('profile.advert')); ?>">
                    <img src="<?php echo e(asset('images/profile/folder.svg')); ?>" alt="Оголошення">Мої оголошення
                </a>
            </div>

            <div class="profile-item">
                <a class="profile-link <?php echo e(is_active('profile/wishlist')); ?>" href="<?php echo e(route('profile.wishlist')); ?>">
                    <img src="<?php echo e(asset('images/profile/heart.svg')); ?>" alt="Вподобання">Вподобання
                </a>
            </div>

            <div class="profile-item">
                <a class="profile-link <?php echo e(is_active('profile/sales')); ?>"
                   href="<?php echo e(route('profile.sales.index')); ?>">
                    <img src="<?php echo e(asset('images/profile/chart.svg')); ?>" alt="Продажі">Мої продажі
                </a>
            </div>

            <div class="profile-item">
                <a class="profile-link <?php echo e(is_active('profile/orders/history')); ?>"
                   href="<?php echo e(route('profile.orders.history')); ?>">
                    <img src="<?php echo e(asset('images/profile/notebook.svg')); ?>" alt="Історія">Історія замовлень
                </a>
            </div>

            <div class="profile-item">
                <a class="profile-link" href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <img src="<?php echo e(asset('images/profile/logout.svg')); ?>" alt="Вийти">Вийти
                    <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST">
                        <?php echo csrf_field(); ?>
                    </form>
                </a>
            </div>
        </div>
    </aside>
</header>

<div class="mobile-footer">
    <a href="<?php echo e(route('home')); ?>">
        <img src="<?php echo e(asset('images/header/home.svg')); ?>" alt="Home">
        <span>Головна</span>
    </a>
    <a href="<?php echo e(route('profile.wishlist')); ?>">
        <img src="<?php echo e(asset('images/header/heart.svg')); ?>" alt="Wishlist">
        <span>Улюблене</span>
        <span class="badge"><?php echo e($wishlistCount); ?></span>
    </a>
    <a href="<?php echo e(route('advert.create')); ?>">
        <img src="<?php echo e(asset('images/header/add.svg')); ?>" alt="Add">
        <span>Додати</span>
    </a>
    <a href="<?php echo e(route('profile.orders.index')); ?>">
        <img src="<?php echo e(asset('images/header/cart.svg')); ?>" alt="Cart">
        <span>Кошик</span>
        <span class="badge"><?php echo e($ordersCount); ?></span>
    </a>
    <a href="<?php echo e(route('profile.index')); ?>">
        <img src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Profile">
        <span>Профіль</span>
    </a>
</div>

<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/partials/header.blade.php ENDPATH**/ ?>