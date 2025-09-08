<form method="GET" id="sort-form">
    <label for="sort-options"></label>
    <select name="sort" class="sort-options" id="sort-options">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($value); ?>" <?php if($selected === $value): echo 'selected'; endif; ?>>
                <?php echo e($text); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</form>

<?php $__env->startPush('scripts'); ?>
    <script>
        $('#sort-options').on('change', function () {
            const form = this.form;

            if (!this.value) {
                form.action = new URL(form.action, window.location.origin).pathname;
            }

            form.submit();
        });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/ui/sort-options.blade.php ENDPATH**/ ?>