<?php $__env->startSection('app-content'); ?>
    <div class="advert-content">
        <div class="advert-details">
            <div class="advert-gallery">

            </div>

            <div class="advert-info">
                <div class="advert-rating">
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Star">
                    <?php endfor; ?>
                    <span class="rating-value">0.0</span>
                </div>

                <h2 class="advert-title"><?php echo e($advert->title); ?></h2>
                <p><?php echo e($advert->description); ?></p>

                <div class="advert-tags">
                    <span class="tag">#Собаки</span>
                    <span class="tag">#Їжа</span>
                    <span class="tag">#Здоров'я</span>
                </div>

                <p class="advert-price"><?php echo e($advert->price); ?> ₴</p>
            </div>
        </div>

        <div class="seller-info">
            <div class="seller">

                <span class="seller-name">
                    Dmytro Markevych
                </span>

                <span class="post-date">Posted: 123</span>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/preview.blade.php ENDPATH**/ ?>