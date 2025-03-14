<a href="<?php echo e(route('adverts.show', $advert->id)); ?>" class="advert-link">
    <div class="advert-card">
        <div class="image-container">
            <img src="<?php echo e(Storage::disk('s3')->url($advert->images->first()->image_path)); ?>" alt="<?php echo e($advert->title); ?>"
                 class="advert-image">
            <form class="add-to-cart-form" action="<?php echo e(route('wishlist.add', $advert->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="favorite-button">
                    <span>Додати до улюбленого</span>
                    <img src="<?php echo e(asset('images/heart.svg')); ?>" alt="">
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

<script>
    $(document).ready(function () {
        $('.add-to-cart-form').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.post({
                url: form.attr('action'),
                data: form.serialize(),
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function () {
                    location.reload();
                }
            });
        });
    });
</script>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert-card.blade.php ENDPATH**/ ?>