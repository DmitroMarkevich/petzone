<?php $__env->startSection('title', $advert->title); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="page-container">
        <div class="breadcrumb">
            <a href="<?php echo e(route('profile.adverts')); ?>">
                <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">
            </a>
            <span class="category-path">Dogs / Food / Vitamins</span>
        </div>

        <div class="advert-content">
            <div class="advert-details">
                <div class="advert-gallery">
                    <div class="main-image">
                        <img src="<?php echo e($mainImageUrl); ?>" alt="Advert Image">
                    </div>

                    <div class="thumbnail-images">
                        <?php $__currentLoopData = $thumbnailUrls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e($url); ?>" alt="Thumbnail">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
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

                    <div class="form-row">
                        <p class="advert-price"><?php echo e($advert->price); ?> ₴</p>
                        <button class="buy-button">
                            Купити <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart Icon">
                        </button>
                    </div>
                </div>
            </div>

            <div class="seller-info">
                <div class="seller">
                    <img id="profile-avatar" src="<?php echo e($avatarUrl); ?>" alt="User Avatar" class="profile-avatar">
                    <span class="seller-name"><?php echo e($advert->user->first_name); ?> <?php echo e($advert->user->last_name); ?></span>
                    <span class="post-date">Posted: <?php echo e($advert->created_at->format('d/m/Y H:i')); ?></span>
                </div>

                <button class="view-number">View number</button>
                <button class="view-email">View Email</button>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/show.blade.php ENDPATH**/ ?>