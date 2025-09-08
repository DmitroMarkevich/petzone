<div>
    <a href="<?php echo e(route('social.login', ['provider' => 'google'])); ?>" class="button google">
        <img src="<?php echo e(asset('images/auth/google.svg')); ?>" alt="Google Icon">
        <?php echo e(__('auth.google_login')); ?>

    </a>

    <a href="<?php echo e(route('social.login', ['provider' => 'facebook'])); ?>" class="button facebook">
        <img src="<?php echo e(asset('images/auth/facebook.svg')); ?>" alt="Facebook Icon">
        <?php echo e(__('auth.facebook_login')); ?>

    </a>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views\components\partials\social-buttons.blade.php ENDPATH**/ ?>