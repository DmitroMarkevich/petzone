<?php $__env->startSection('profile-content'); ?>
    <?php if($orders->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div>
            <h2 class="page-title">Ваші замовлення</h2>
            <?php if (isset($component)) { $__componentOriginalc6be867d00e6e5fdd63b7716c605e040 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6be867d00e6e5fdd63b7716c605e040 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.orders-table','data' => ['orders' => $orders]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('orders-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($orders)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc6be867d00e6e5fdd63b7716c605e040)): ?>
<?php $attributes = $__attributesOriginalc6be867d00e6e5fdd63b7716c605e040; ?>
<?php unset($__attributesOriginalc6be867d00e6e5fdd63b7716c605e040); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6be867d00e6e5fdd63b7716c605e040)): ?>
<?php $component = $__componentOriginalc6be867d00e6e5fdd63b7716c605e040; ?>
<?php unset($__componentOriginalc6be867d00e6e5fdd63b7716c605e040); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/orders.blade.php ENDPATH**/ ?>