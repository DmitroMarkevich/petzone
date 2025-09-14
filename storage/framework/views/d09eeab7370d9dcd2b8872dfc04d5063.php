<?php $__env->startSection('title', 'Ваші замовлення'); ?>

<?php $__env->startSection('profile-content'); ?>
    <?php if($orders->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div>
            <h2 class="page-title">Ваші замовлення</h2>
            <?php if (isset($component)) { $__componentOriginaldc7fd4df7c34c6a0b91da8c62188309c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldc7fd4df7c34c6a0b91da8c62188309c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.order.table','data' => ['orders' => $orders->getCollection()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('order.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($orders->getCollection())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldc7fd4df7c34c6a0b91da8c62188309c)): ?>
<?php $attributes = $__attributesOriginaldc7fd4df7c34c6a0b91da8c62188309c; ?>
<?php unset($__attributesOriginaldc7fd4df7c34c6a0b91da8c62188309c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldc7fd4df7c34c6a0b91da8c62188309c)): ?>
<?php $component = $__componentOriginaldc7fd4df7c34c6a0b91da8c62188309c; ?>
<?php unset($__componentOriginaldc7fd4df7c34c6a0b91da8c62188309c); ?>
<?php endif; ?>

            <?php if($orders->hasPages()): ?>
                <?php echo e($orders->links()); ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/orders/index.blade.php ENDPATH**/ ?>