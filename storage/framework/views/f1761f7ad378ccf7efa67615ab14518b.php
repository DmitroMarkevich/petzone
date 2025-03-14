<?php $__env->startSection('content'); ?>
    <div class="container-fluid d-flex justify-content-center align-items-center full-height-container">
        <div class="text-center">
            <h1 class="display-1 text-danger">404</h1>
            <h2 class="mb-4">Page Not Found</h2>
            <p class="text-muted mb-4">The page you are looking for doesn't exist.</p>
            <a href="<?php echo e(route('home')); ?>" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/errors/404.blade.php ENDPATH**/ ?>