<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['type' => 'text', 'name', 'label', 'placeholder' => '', 'value' => old($name)]));

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

foreach (array_filter((['type' => 'text', 'name', 'label', 'placeholder' => '', 'value' => old($name)]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<label for="<?php echo e($name); ?>"><?php echo e(__($label)); ?></label>
<div class="input-wrapper">
    <input
        id="<?php echo e($name); ?>"
        type="<?php echo e($type); ?>"
        name="<?php echo e($name); ?>"
        value="<?php echo e($value); ?>"
        class="input-field <?php echo e($errors->has($name) ? 'invalid' : ''); ?>"
        <?php echo e($attributes->merge(['required'])); ?>

        placeholder="<?php echo e($placeholder); ?>"
        data-validation="<?php echo e($type); ?>"
    >

    <?php if($type === 'password'): ?>
        <button type="button" class="toggle-visibility">
            <img id="eye-icon" src="<?php echo e(asset('images/auth/eye-closed.svg')); ?>" alt="Toggle Visibility">
        </button>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/input.blade.php ENDPATH**/ ?>