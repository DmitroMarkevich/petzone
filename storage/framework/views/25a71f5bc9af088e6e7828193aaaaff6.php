<div class="advert-card">
    <div class="image-container">
        <a href="<?php echo e(route('adverts.show', $advert->id)); ?>" class="advert-link">
            <img class="advert-image" src="<?php echo e($advert->mainImage); ?>" alt="<?php echo e($advert->title); ?>">
        </a>

        <form class="wishlist-form" data-action="<?php echo e(route('wishlist.toggle', $advert->id)); ?>"
              data-id="<?php echo e($advert->id); ?>">
            <?php echo csrf_field(); ?>
            <button type="button" class="favorite-button" data-id="<?php echo e($advert->id); ?>">
                <img src="<?php echo e($heartIcon); ?>" alt="Heart" class="heart-icon" data-id="<?php echo e($advert->id); ?>">
            </button>
        </form>
    </div>

    <div class="advert-details">
        <div class="advert-tags">
            <?php $__currentLoopData = $tags ?? ['Собаки', 'Їжа', "Здоров'я"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="tag">#<?php echo e($tag); ?></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <h3 class="advert-title"><?php echo e($advert->title); ?></h3>

        <div class="advert-rating" role="img" aria-label="<?php echo e($advert->average_rating); ?>">
            <?php for($i = 1; $i <= 5; $i++): ?>
                <img src="<?php echo e(asset('images/star.svg')); ?>"
                     alt="<?php echo e($i <= $advert->average_rating ? 'Star' : 'Empty Star'); ?>">
            <?php endfor; ?>
            <span class="rating-value"><?php echo e($advert->average_rating); ?>.0</span>
        </div>
    </div>

    <div class="price-action">
        <div class="advert-price">
            <?php if($advert->shouldShowDiscountPrice()): ?>
                <span class="old-price"><?php echo e(number_format($advert->previous_price)); ?> ₴</span>
                <h4 class="new-price"><?php echo e(number_format($advert->price)); ?> ₴</h4>
            <?php else: ?>
                <span class="current-price"><?php echo e(number_format($advert->price)); ?> ₴</span>
            <?php endif; ?>
        </div>

        <form action="<?php echo e(route('checkout.select')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="advert_id" value="<?php echo e($advert->id); ?>">
            <button class="buy-button" type="submit">
                Купити <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart Icon">
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).on('click', '.favorite-button', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $button = $(this);
        if ($button.prop('disabled')) return;

        const $form = $button.closest('.wishlist-form');
        const $icon = $button.find('.heart-icon');

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $button.prop('disabled', true);

        $.ajax({
            url: $form.data('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function(response) {
                $icon.attr('src', `/images/${response.in_wishlist ? 'heart-filled.svg' : 'heart.svg'}`);
            }, complete: function() {
                $button.prop('disabled', false);
            }
        });
    });
</script>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert/card.blade.php ENDPATH**/ ?>