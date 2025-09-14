<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'items',
    'filters' => [],
    'queryKey' => 'filter',
]));

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

foreach (array_filter(([
    'items',
    'filters' => [],
    'queryKey' => 'filter',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $currentValue = request($queryKey);
?>

<div class="filter-buttons">
    <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $value = $filter['value'];
            $label = $filter['label'];
            $key = $queryKey;

            $count = $items->filter(fn ($item) => data_get($item, $filter['key']) == $value)->count();

            $isActive = (string) $currentValue === (string) $value;

            $totalCount = $items->count();
            $isAllActive = is_null($currentValue);
        ?>

        <a href="<?php echo e(request()->fullUrlWithQuery([$queryKey => null])); ?>"
           class="filter-button <?php echo e($isAllActive ? 'active' : ''); ?>">
            Всі (<?php echo e($totalCount); ?>)
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/ui/filter-buttons.blade.php ENDPATH**/ ?>