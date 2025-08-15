<div class="advert-card">
    <a href="<?php echo e(route('adverts.show', $advert->id)); ?>" class="advert-link">
        <div class="image-container">
            <a href="<?php echo e(route('adverts.show', $advert->id)); ?>" class="advert-link">
                <img class="advert-image" src="<?php echo e($advert->main_image); ?>" alt="<?php echo e($advert->title); ?>">
            </a>

            <form class="wishlist-form" data-action="<?php echo e(route('wishlist.toggle', $advert->id)); ?>"
                  data-id="<?php echo e($advert->id); ?>">
                <?php echo csrf_field(); ?>
                <button type="button" class="favorite-button" data-id="<?php echo e($advert->id); ?>">
                    <img
                        src="<?php echo e($advert->in_wishlist ? asset('images/heart-filled.svg') : asset('images/heart.svg')); ?>"
                        alt="Heart" class="heart-icon" data-id="<?php echo e($advert->id); ?>"
                    >
                </button>
            </form>
        </div>

        <div class="advert-details">
            <div class="advert-tags">
                <span class="tag">#Собаки</span>
                <span class="tag">#Їжа</span>
                <span class="tag">#Здоров'я</span>
            </div>

            <h3 class="advert-title"><?php echo e($advert->title); ?></h3>

            <div class="advert-rating" role="img" aria-label="<?php echo e($advert->average_rating); ?>">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <?php if($i <= $advert->average_rating): ?>
                        <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Star">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Empty Star">
                    <?php endif; ?>
                <?php endfor; ?>
                <span class="rating-value"><?php echo e($advert->average_rating); ?>.0</span>
            </div>
        </div>

        <div class="price-action">
            <p class="advert-price"><?php echo e($advert->price); ?> ₴</p>

            <button class="buy-button" type="button">
                Купити <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart Icon">
            </button>
        </div>
    </a>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert-card.blade.php ENDPATH**/ ?>