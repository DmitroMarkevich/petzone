<?php
    $checked = old('delivery_method') == $value ? 'checked' : '';
?>

<label for="<?php echo e($id); ?>">
    <input type="radio" id="<?php echo e($id); ?>" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" <?php echo e($checked); ?>>
    <?php echo e($label); ?>

</label>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/radio-button.blade.php ENDPATH**/ ?>