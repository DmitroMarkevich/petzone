<div class="advert-item">
    <div class="advert-left">
        <div class="advert-image-wrapper">
            <?php
                $firstImage = $advert->images->first();
                $imageUrl = asset('images/advert-test.jpg');

                if ($firstImage && $firstImage->image_path) {
                    $imageUrl = Storage::disk('s3')->url($firstImage->image_path);
                }
            ?>

            <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($advert->title); ?>" class="advert-image">
        </div>

        <div class="advert-content">
            <a class="advert-title" href="<?php echo e(route('adverts.show', $advert->id)); ?>"><?php echo e($advert->title); ?></a>
            <p class="advert-description"><?php echo e($advert->description); ?></p>

            <div class="advert-date-wrapper">
                <img src="<?php echo e(asset('images/profile/calendar.svg')); ?>" alt="Calendar" class="advert-date-icon">
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
        <p class="advert-price"><?php echo e($advert->price); ?>₴</p>

        <?php if(isset($actions)): ?>
            <div class="advert-actions">
                <?php echo e($actions); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert-item.blade.php ENDPATH**/ ?>