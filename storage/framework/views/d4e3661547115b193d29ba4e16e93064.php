<a href="<?php echo e(route('adverts.show', $advert->id)); ?>">
    <div class="advert-card">
        <div class="image-container">
            <?php if($advert->images->isNotEmpty()): ?>
                <img class="advert-image" src="<?php echo e(Storage::disk('s3')->url($advert->images->first()->image_path)); ?>"
                     alt="<?php echo e($advert->title); ?>">
            <?php else: ?>
                <img class="advert-image" src="<?php echo e(asset('images/advert-test.jpg')); ?>" alt="<?php echo e($advert->title); ?>">
            <?php endif; ?>

            <form action="<?php echo e(route('wishlist.toggle', $advert->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="favorite-button">
                    <span>Додати до улюбленого</span>
                    <?php
                        $isInWishlist = in_array($advert->id, session('wishlist', []));
                        $heartIcon = $isInWishlist ? 'images/heart-filled.svg' : 'images/heart.svg';
                    ?>
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

            <div class="advert-rating">
                <?php for($i = 0; $i < 5; $i++): ?>
                    <img src="<?php echo e(asset('images/star.svg')); ?>" alt="Star">
                <?php endfor; ?>
                <span class="rating-value">0.0</span>
            </div>
        </div>

        <div class="price-action">
            <p class="advert-price"><?php echo e($advert->price); ?> ₴</p>

            <button class="buy-button">
                Купити <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart Icon">
            </button>
        </div>
    </div>
</a>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert-card.blade.php ENDPATH**/ ?>