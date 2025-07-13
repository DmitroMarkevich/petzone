<?php
    $isInWishlist = in_array($advert->id, session('wishlist', []));
    $heartIcon = $isInWishlist ? 'images/heart-filled.svg' : 'images/heart.svg';

    $imageUrl = $advert->images->isNotEmpty()
        ? Storage::disk('s3')->url($advert->images->first()->image_path)
        : asset('images/advert-test.jpg');
?>

<a href="<?php echo e(route('adverts.show', $advert->id)); ?>">
    <div class="advert-card">
        <div class="image-container">
            <img class="advert-image" src="<?php echo e($imageUrl); ?>" alt="<?php echo e($advert->title); ?>">

            <form action="<?php echo e(route('wishlist.toggle', $advert->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="favorite-button" aria-label="Додати до улюбленого">
                    <span>Додати до улюбленого</span>
                    <img src="<?php echo e(asset($heartIcon)); ?>" alt="Heart">
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
    </div>
</a>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert-card.blade.php ENDPATH**/ ?>