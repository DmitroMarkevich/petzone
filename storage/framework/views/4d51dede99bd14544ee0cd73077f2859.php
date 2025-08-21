<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'name',
    'label' => '',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Оберіть варіант',
    'required' => false,
    'class' => 'form-control'
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
    'id',
    'name',
    'label' => '',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Оберіть варіант',
    'required' => false,
    'class' => 'form-control'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div>
    <?php if($label): ?>
        <label for="<?php echo e($id); ?>"><?php echo e($label); ?></label>
    <?php endif; ?>

    <select id="<?php echo e($id); ?>" name="<?php echo e($name); ?>" class="<?php echo e($class); ?>" <?php echo e($required ? 'required' : ''); ?>>
            <option value=""><?php echo e($placeholder); ?></option>

            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $optionValue = is_object($value) ? $value->id : $key;
                    $optionLabel = is_object($value) ? $value->name : $value;
                    $isSelected = old($name, $selected) == $optionValue;
                ?>
                <option value="<?php echo e($optionValue); ?>" <?php echo e($isSelected ? 'selected' : ''); ?>>
                    <?php echo e($optionLabel); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/form/select.blade.php ENDPATH**/ ?>