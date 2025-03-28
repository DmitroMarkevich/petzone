<?php
    $checked = $checked ?? false;
?>

<label>
    <input type="radio" name="<?php echo e($name); ?>" <?php echo e($checked ? 'checked' : ''); ?>>
    <span class="custom-radio"></span>
    <?php echo e($label); ?>

</label>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/radio-button.blade.php ENDPATH**/ ?>