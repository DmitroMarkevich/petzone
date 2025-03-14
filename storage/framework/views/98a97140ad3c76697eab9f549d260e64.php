<?php $__env->startSection('profile-content'); ?>
    <div>
        <?php if(false): ?>
            <div class="no-adverts">
                <p>No orders found.</p>
            </div>
        <?php else: ?>
            <h2 class="page-title">Історія замовлень</h2>
            <?php if (isset($component)) { $__componentOriginalc6be867d00e6e5fdd63b7716c605e040 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6be867d00e6e5fdd63b7716c605e040 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.orders-table','data' => ['orders' => $orders,'short' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('orders-table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($orders),'short' => true]); ?>
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
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/orders-history.blade.php ENDPATH**/ ?>