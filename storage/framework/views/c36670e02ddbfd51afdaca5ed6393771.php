<?php $__env->startSection('profile-content'); ?>
    <div class="adverts-container">
        <?php if($adverts->isEmpty()): ?>
            <div class="no-adverts">
                <p>No adverts found.</p>
            </div>
        <?php else: ?>
            <h2 class="page-title">Мої оголошення</h2>
            <div class="adverts-list">
                <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="advert-item">
                        <div class="advert-left">
                            <div class="advert-image-wrapper">
                                <img src="<?php echo e(Storage::disk('s3')->url($advert->images->first()->image_path)); ?>"
                                     alt="<?php echo e($advert->title); ?>" class="advert-image">
                            </div>

                            <div class="advert-content">
                                <h3 class="advert-title"><?php echo e($advert->title); ?></h3>
                                <p class="advert-description"><?php echo e($advert->description); ?></p>

                                <div class="advert-date-wrapper">
                                    <img src="<?php echo e(asset('images/profile/calendar.svg')); ?>" alt="Calendar"
                                         class="advert-date-icon">
                                    <span class="advert-date"><?php echo e($advert->created_at->format('d.m.y')); ?></span>
                                </div>

                                <div class="advert-tags">
                                    <span class="tag">#Собаки</span>
                                    <span class="tag">#Їжа</span>
                                    <span class="tag">#Здоров'я</span>
                                </div>
                            </div>
                        </div>

                        <div class="advert-right">
                            <div class="advert-price-wrapper">
                                <span class="advert-price"><?php echo e($advert->price); ?>₴</span>
                            </div>

                            <div class="advert-actions">
                                <button class="edit-btn">Редагувати</button>
                                <form action="<?php echo e(route('adverts.destroy', $advert->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="delete-btn">Видалити</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/adverts.blade.php ENDPATH**/ ?>