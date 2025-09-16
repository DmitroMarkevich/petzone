<div class="advert-card <?php echo e($small ? 'advert-card--small' : ''); ?>">
    <div class="image-container">
        <a href="<?php echo e(route('advert.show', $advert->id)); ?>">
            <img class="advert-image" src="<?php echo e($advert->mainImage); ?>" alt="<?php echo e($advert->title); ?>">
        </a>

        <form class="wishlist-form" data-action="<?php echo e(route('wishlist.toggle', $advert->id)); ?>">
            <?php echo csrf_field(); ?>
            <button type="button" class="favorite-button" data-id="<?php echo e($advert->id); ?>" data-active="<?php echo e($isInWishlist ? 'true' : 'false'); ?>">
                Додати до улюбленого <img src="<?php echo e($heartIcon); ?>" alt="Heart">
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
        <?php if (isset($component)) { $__componentOriginald51ff61c4f49ffd1eb36143e10c4abc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald51ff61c4f49ffd1eb36143e10c4abc3 = $attributes; } ?>
<?php $component = App\View\Components\AdvertRating::resolve(['rating' => $advert->average_rating] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert-rating'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdvertRating::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald51ff61c4f49ffd1eb36143e10c4abc3)): ?>
<?php $attributes = $__attributesOriginald51ff61c4f49ffd1eb36143e10c4abc3; ?>
<?php unset($__attributesOriginald51ff61c4f49ffd1eb36143e10c4abc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald51ff61c4f49ffd1eb36143e10c4abc3)): ?>
<?php $component = $__componentOriginald51ff61c4f49ffd1eb36143e10c4abc3; ?>
<?php unset($__componentOriginald51ff61c4f49ffd1eb36143e10c4abc3); ?>
<?php endif; ?>
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
            <button class="buy-button" type="submit">Купити
                <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart Icon">
            </button>
        </form>
    </div>
</div>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert/card.blade.php ENDPATH**/ ?>