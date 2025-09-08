<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['orders', 'short' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['orders', 'short' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="orders-container <?php echo e($short ? 'orders-container--short' : ''); ?>">
    <div class="orders-header">
        <span>Номер замовлення</span>
        <span>Дата і час</span>
        <span>Статус відправлення</span>
        <span>Номер відстеження</span>
        <span>Ціна</span>
        <?php if (! ($short)): ?>
            <span>Більше</span>
        <?php endif; ?>
    </div>

    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="order-row">
            <span><?php echo e($order->order_number); ?></span>
            <span><?php echo e($order->created_at->format('d/m/Y H:i')); ?></span>
            <div class="status <?php echo e(strtolower($order->status->value)); ?>">
                <?php echo e(App\Enum\OrderStatus::getTranslation($order->status)); ?>

            </div>
            <span><?php echo e($order->tracking_number ?? '—'); ?></span>
            <span>₴<?php echo e($order->total_price ?? '—'); ?></span>
            <?php if (! ($short)): ?>
                <a href="<?php echo e(route('profile.orders.show', $order->id)); ?>">Подивитися</a>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views\components\order\table.blade.php ENDPATH**/ ?>