<form method="GET"
      x-data="{
          sortValue: '<?php echo e($selected); ?>',
          submitForm() {
              const form = this.$refs.sortForm;

              if (!this.sortValue) {
                  form.action = new URL(form.action, window.location.origin).pathname;
              }

              form.submit();
          }
      }"
      x-ref="sortForm"
      id="sort-form">

    <label for="sort-options"></label>
    <select name="sort" class="sort-options" id="sort-options" x-model="sortValue" @change="submitForm()">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($value); ?>" <?php if($selected === $value): echo 'selected'; endif; ?>>
                <?php echo e($text); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <?php $__currentLoopData = request()->except('sort', 'page'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</form>

<style>

</style>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/ui/sort-options.blade.php ENDPATH**/ ?>