<div class="filter-buttons">
    <button class="filter-button active" data-status="all">
        Всі (<?php echo e($counts['all'] ?? 0); ?>)
    </button>

    <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <button class="filter-button" data-status="<?php echo e(strtolower($filter['value'])); ?>">
            <?php echo e($filter['label'] ?? $filter['value']); ?> (<?php echo e($counts["{$filter['key']}.{$filter['value']}"] ?? 0); ?>)
        </button>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/ui/filter-buttons.blade.php ENDPATH**/ ?>