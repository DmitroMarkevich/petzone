<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'success', 'message' => '']));

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

foreach (array_filter((['type' => 'success', 'message' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $styles = [
        'success' => [
            'title' => 'Дякуємо!',
            'iconFill' => 'green',
            'iconPath' => 'M9 16.17L4.83 12l-1.42 1.41L9 19l12-12-1.41-1.42z',
        ],
        'error' => [
            'title' => 'Помилка!',
            'iconFill' => 'red',
            'iconPath' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z',
        ],
    ];
    $current = $styles[$type];
?>

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 2000)"
    x-show="show"
    x-transition:leave="transition ease-in duration-400"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="flash-message flash-message--<?php echo e($type); ?>"
>
    <svg class="icon" viewBox="0 0 24 24">
        <path fill="<?php echo e($current['iconFill']); ?>" d="<?php echo e($current['iconPath']); ?>"/>
    </svg>

    <h3 class="title"><?php echo e($current['title']); ?></h3>
    <p><?php echo e($message); ?></p>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/ui/flash-message.blade.php ENDPATH**/ ?>