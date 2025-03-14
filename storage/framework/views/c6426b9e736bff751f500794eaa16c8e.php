<?php $__env->startSection('content'); ?>
    <div class="auth-container">
        <div class="auth-left">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('images/white-logo.svg')); ?>" alt="Logo">
            </a>
            <div class="image">
                <img src="<?php echo e(asset('images/auth/cart.svg')); ?>" alt="Cart Image">
            </div>
            <p class="tagline">Широкий вибір товарів</p>
        </div>

        <div class="auth-right">
            <?php echo $__env->yieldContent('auth-content'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/auth.blade.php ENDPATH**/ ?>