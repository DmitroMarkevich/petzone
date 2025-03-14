<?php $__env->startSection('profile-content'); ?>
    <div class="page-container">
        <?php if($wishlist->isEmpty()): ?>
            <div class="no-adverts">
                <p>No adverts found.</p>
            </div>
        <?php else: ?>
            <div class="advert-grid">
                <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('components.advert-card', ['wishlist' => $advert], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/wishlist.blade.php ENDPATH**/ ?>