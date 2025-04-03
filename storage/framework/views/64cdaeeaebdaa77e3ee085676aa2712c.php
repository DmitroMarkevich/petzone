<?php $__env->startSection('title', 'Мій профіль'); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="page-container">
        <div class="profile-template">
            <div class="profile-sidebar">
                <div class="profile-navigation-item">
                    <a class="profile-navigation-link <?php echo e(request()->is('profile') ? 'active' : ''); ?>"
                       href="<?php echo e(route('profile.index')); ?>">
                        <img src="<?php echo e(asset('images/profile/profile.svg')); ?>" alt="Профіль">Профіль
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link <?php echo e(request()->is('profile/orders') ? 'active' : ''); ?>"
                       href="<?php echo e(route('profile.orders')); ?>">
                        <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Замовлення">Замовлення
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link <?php echo e(request()->is('profile/adverts') ? 'active' : ''); ?>"
                       href="<?php echo e(route('profile.adverts')); ?>">
                        <img src="<?php echo e(asset('images/profile/folder.svg')); ?>" alt="Оголошення">Мої оголошення
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link <?php echo e(request()->is('profile/wishlist') ? 'active' : ''); ?>"
                       href="<?php echo e(route('profile.wishlist')); ?>">
                        <img src="<?php echo e(asset('images/profile/heart.svg')); ?>" alt="Вподобання">Вподобання
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link <?php echo e(request()->is('profile/orders-history') ? 'active' : ''); ?>"
                       href="<?php echo e(route('profile.orders.history')); ?>">
                        <img src="<?php echo e(asset('images/profile/notebook.svg')); ?>" alt="Історія">Історія замовлень
                    </a>
                </div>

                <div class="profile-navigation-item">
                    <a class="profile-navigation-link" href="<?php echo e(route('logout')); ?>"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="<?php echo e(asset('images/profile/logout.svg')); ?>" alt="Вийти">Вийти
                        <form action="<?php echo e(route('logout')); ?>" id="logout-form" method="POST">
                            <?php echo csrf_field(); ?>
                        </form>
                    </a>
                </div>
            </div>

            <div class="profile-content">
                <?php echo $__env->yieldContent('profile-content'); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/profile.blade.php ENDPATH**/ ?>