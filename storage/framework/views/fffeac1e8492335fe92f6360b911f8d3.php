<header class="page-container">
    <nav class="navbar">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('images/blue-logo.svg')); ?>" alt="Logo" class="logo">
        </a>

        <form action="<?php echo e(route('adverts.index')); ?>" method="GET">
            <div class="input-group">
                <button class="category-btn" type="button" aria-label="Категорії" id="categoryToggle">
                    <img src="<?php echo e(asset('images/header/category.svg')); ?>" alt="Категорії" class="category-icon">
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
                       aria-label="Search" value="<?php echo e(request('query')); ?>">
                <button class="search-btn" type="submit" aria-label="Search">
                    <img src="<?php echo e(asset('images/header/search.svg')); ?>" alt="Search">
                </button>
            </div>
        </form>

        <div class="navbar-right">
            <a class="nav-link" href="<?php echo e(route('profile.wishlist')); ?>" aria-label="Wishlist">
                <img src="<?php echo e(asset('images/header/heart.svg')); ?>" alt="Wishlist" class="icon-heart">
                <span class="badge"><?php echo e(auth()->user()->wishlist()->count()); ?></span>
            </a>

            <a class="nav-link" href="<?php echo e(route('profile.orders.index')); ?>" aria-label="Cart">
                <img src="<?php echo e(asset('images/header/cart.svg')); ?>" alt="Cart" class="icon-cart">
                <span class="badge"><?php echo e(auth()->user()->orders()->count()); ?></span>
            </a>

            <a class="nav-avatar" href="<?php echo e(route('profile.index')); ?>">
                <?php if(!empty(auth()->user()->image_path)): ?>
                    <img src="<?php echo e(image_url(auth()->user()->image_path)); ?>" alt="Avatar" class="nav-avatar-image">
                <?php else: ?>
                    <img src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Avatar" class="nav-avatar-image">
                <?php endif; ?>
            </a>

            <a href="<?php echo e(route('adverts.create')); ?>" class="hero-button">Додати оголошення</a>
        </div>
    </nav>
</header>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/partials/header.blade.php ENDPATH**/ ?>