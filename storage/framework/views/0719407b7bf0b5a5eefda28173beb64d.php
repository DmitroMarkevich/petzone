<div class="advert-rating" role="img" aria-label="Рейтинг <?php echo e($rating); ?>">
    <div class="stars-wrapper">
        <?php for($i = 1; $i <= 5; $i++): ?>
            <img src="<?php echo e($i <= $starsToShow ? asset('images/star-filled.svg') : asset('images/star.svg')); ?>"
                 alt="Star">
        <?php endfor; ?>
    </div>
    <span class="rating-value"><?php echo e(number_format($rating, 1)); ?></span>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert/rating.blade.php ENDPATH**/ ?>