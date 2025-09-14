<?php $__env->startSection('title', 'Мій профіль'); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="page-container">
        <div class="profile-template" x-data="{ sidebarOpen: false }">
            <div class="profile-sidebar">
                <?php if (isset($component)) { $__componentOriginala79e8c508b1bcb1544fa83672f5ecaa9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala79e8c508b1bcb1544fa83672f5ecaa9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.partials.profile.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('partials.profile.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala79e8c508b1bcb1544fa83672f5ecaa9)): ?>
<?php $attributes = $__attributesOriginala79e8c508b1bcb1544fa83672f5ecaa9; ?>
<?php unset($__attributesOriginala79e8c508b1bcb1544fa83672f5ecaa9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala79e8c508b1bcb1544fa83672f5ecaa9)): ?>
<?php $component = $__componentOriginala79e8c508b1bcb1544fa83672f5ecaa9; ?>
<?php unset($__componentOriginala79e8c508b1bcb1544fa83672f5ecaa9); ?>
<?php endif; ?>
            </div>

            <div class="profile-content">
                <?php echo $__env->yieldContent('profile-content'); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/profile.blade.php ENDPATH**/ ?>