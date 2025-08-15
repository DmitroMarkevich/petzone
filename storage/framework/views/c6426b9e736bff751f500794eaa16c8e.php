<?php $__env->startSection('content'); ?>
    <div class="auth-container">
        <div class="auth-left">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img class="navbar-logo" src="<?php echo e(asset('images/white-logo.svg')); ?>" alt="Logo">
            </a>

            <div class="image-slider">
                <div class="slider-frame">
                    <img id="slider-image" src="<?php echo e(asset('images/auth/shopping-cart.png')); ?>" alt="Slider Image">
                    <p id="slider-text" class="tagline"><?php echo e(__('auth.slider.shopping_cart')); ?></p>
                </div>

                <div class="slider-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>

                <div id="slider-container"
                     data-shopping-cart="<?php echo e(__('auth.slider.shopping_cart')); ?>"
                     data-carton="<?php echo e(__('auth.slider.carton')); ?>"
                     data-receipt="<?php echo e(__('auth.slider.receipt')); ?>" hidden>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <?php echo $__env->yieldContent('auth-content'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/auth.blade.php ENDPATH**/ ?>