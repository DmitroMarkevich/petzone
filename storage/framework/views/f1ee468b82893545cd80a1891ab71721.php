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
    <a class="profile-link <?php echo e(is_active('profile/sales')); ?>" href="<?php echo e(route('profile.sales.index')); ?>">
        <img src="<?php echo e(asset('images/profile/chart.svg')); ?>" alt="Продажі">Мої продажі
    </a>
</div>

<div class="profile-item">
    <a class="profile-link <?php echo e(is_active('profile/orders/history')); ?>" href="<?php echo e(route('profile.orders.history')); ?>">
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
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/partials/profile/sidebar.blade.php ENDPATH**/ ?>