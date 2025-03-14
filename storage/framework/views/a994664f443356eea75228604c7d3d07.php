<?php $__env->startSection('content'); ?>
    <header class="header">
        <div class="page-container">
            <nav class="navbar">
                <a href="<?php echo e(route('home')); ?>" class="logo-container">
                    <img src="<?php echo e(asset('images/blue-logo.svg')); ?>" alt="PetZone Logo" class="logo">
                </a>

                <div class="navbar-center">
                    <form class="search-form" action="<?php echo e(route('adverts.search')); ?>" method="GET">
                        <div class="input-group">
                            <button class="category-btn" type="button" aria-label="Категорії" id="categoryToggle">
                                <img src="<?php echo e(asset('images/header/category.svg')); ?>" alt="Категорії"
                                     class="category-icon">
                                Категорії
                            </button>

                            <div class="category-menu" id="categoryMenu">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <img src="<?php echo e(asset('images/header/category/dog.svg')); ?>" alt="Собака"
                                                 class="category-image">
                                            Для Собак
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img src="<?php echo e(asset('images/header/category/cat.svg')); ?>" alt="Кіт"
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
                                   aria-label="Search" value="<?php echo e(request('query')); ?>">
                            <button class="search-btn" type="submit" aria-label="Search">
                                <img src="<?php echo e(asset('images/header/search.svg')); ?>" alt="Search">
                            </button>
                        </div>
                    </form>
                </div>

                <div class="navbar-right">
                    <a class="nav-link" href="<?php echo e(route('profile.wishlist')); ?>" aria-label="Wishlist">
                        <img src="<?php echo e(asset('images/header/heart.svg')); ?>" alt="Wishlist" class="icon-heart">
                        <span class="badge"><?php echo e(session('wishlist') ? count(session('wishlist')) : 0); ?></span>
                    </a>
                    <a class="nav-link" href="<?php echo e(route('profile.orders')); ?>" aria-label="Cart">
                        <img src="<?php echo e(asset('images/header/cart.svg')); ?>" alt="Cart" class="icon-cart">
                        <span class="badge"><?php echo e(auth()->user()->orders()->count()); ?></span>
                    </a>
                    <a class="nav-avatar" href="<?php echo e(route('profile.index')); ?>">
                        <?php if(auth()->user() && !empty(auth()->user()->image_path)): ?>
                            <img src="<?php echo e(Storage::disk('s3')->url(auth()->user()->image_path)); ?>" alt="User Avatar"
                                 class="nav-avatar-image">
                        <?php else: ?>
                            <img src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Default Avatar"
                                 class="nav-avatar-image">
                        <?php endif; ?>
                    </a>
                    <a href="<?php echo e(route('adverts.create')); ?>" class="hero-button">Додати оголошення</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <?php echo $__env->yieldContent('app-content'); ?>
    </main>

    <footer class="footer">
        <a href="<?php echo e(route('home')); ?>">
            <img src="<?php echo e(asset('images/white-logo.svg')); ?>" alt="Logo">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/app.blade.php ENDPATH**/ ?>