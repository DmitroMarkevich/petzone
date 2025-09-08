<div class="filter-buttons">
    <?php
        $allFilter = ['label' => 'Всі', 'value' => null, 'count' => $counts['all'] ?? 0];
        $allFilters = array_merge([$allFilter], $filters);
        $currentStatus = $currentFilter ?? request('status');
    ?>

    <?php $__currentLoopData = $allFilters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $value = $filter['value'];
            $label = $filter['label'] ?? $value;
            $count = $filter['count'] ?? 0;
            $isActive = (string) $currentStatus === (string) $value;
        ?>

        <a href="<?php echo e(request()->fullUrlWithQuery(['status' => $value, 'page' => 1])); ?>"
           class="filter-button <?php echo e($isActive ? 'active' : ''); ?>">
            <?php echo e($label); ?> (<?php echo e($count); ?>)
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views\components\ui\filter-buttons.blade.php ENDPATH**/ ?>