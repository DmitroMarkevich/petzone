<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>
        <?php echo e(config('app.name', 'PetZone')); ?>

        <?php if (! empty(trim($__env->yieldContent('title')))): ?> — <?php echo $__env->yieldContent('title'); ?> <?php endif; ?>
    </title>

    <script src="https://unpkg.com/alpinejs" defer></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body data-route="<?php echo e(Route::currentRouteName()); ?>" x-data="{ sidebarOpen: false }">
    <div id="global-loader-overlay" class="hidden"></div>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/base.blade.php ENDPATH**/ ?>