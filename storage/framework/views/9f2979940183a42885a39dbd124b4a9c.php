<div class="advert-item" data-status="<?php echo e($status ?? ''); ?>">
    <div class="advert-main">
        <div class="advert-left">
            <div class="advert-image-wrapper">
                <img src="<?php echo e($advert->main_image); ?>" alt="<?php echo e($advert->title); ?>" class="advert-image">
            </div>

            <div class="advert-content">
                <a class="advert-title" href="<?php echo e(route('adverts.show', $advert->id)); ?>"><?php echo e($advert->title); ?></a>
                <p class="advert-description"><?php echo e($advert->description); ?></p>

                <div class="advert-date-wrapper">
                    <img src="<?php echo e(asset('images/profile/calendar.svg')); ?>" alt="Calendar">
                    <span class="advert-date"><?php echo e($advert->created_at->format('d.m.y')); ?></span>
                </div>

                <div class="advert-tags">
                    <?php $__currentLoopData = $tags ?? ['Собаки', 'Їжа', "Здоров'я"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="tag">#<?php echo e($tag); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <div class="advert-right">
            <p class="advert-price"><?php echo e($advert->price); ?>₴</p>

            <?php if(!empty($actions)): ?>
                <div class="advert-actions"><?php echo e($actions); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert/item.blade.php ENDPATH**/ ?>