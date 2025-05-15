<?php $__env->startSection('app-content'); ?>
    <div class="breadcrumb">
        <a href="#" class="back-link">← Back</a>
        <span class="category-path">Dogs / Food / Vitamins</span>
    </div>

    <div class="advert-content">
        <div class="advert-details">
            <div class="advert-gallery">
                <div class="main-image">
                    <img src="<?php echo e(Storage::disk('s3')->url($advert->images->first()->image_path)); ?>" alt="Advert Image">
                </div>

                <div class="thumbnail-images">
                    <?php $__currentLoopData = $advert->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(Storage::disk('s3')->url($image->image_path)); ?>" alt="Thumbnail">
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
                <img id="profile-avatar"
                     src="<?php echo e(!empty($advert->user->image_path) ? Storage::disk('s3')->url($advert->user->image_path) : asset('images/default-avatar.png')); ?>"
                     alt="User Avatar" class="profile-avatar">

                <span class="seller-name">
                    <?php echo e($advert->user->first_name); ?> <?php echo e($advert->user->last_name); ?>

                </span>

                <span class="post-date">Posted: <?php echo e($advert->created_at->format('d/m/Y H:i')); ?></span>
            </div>
            <button class="view-number">View number</button>
            <button class="view-email">View Email</button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    .advert-details {
        display: flex;
        gap: 32px;
    }

    .advert-gallery {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .main-image img {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
        background: #f0f0f0;
    }

    .thumbnail-images img {
        width: 60px;
        height: 60px;
        cursor: pointer;
    }

    .advert-info {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;

        width: 30%;
        padding: 16px;
        box-shadow: 0 4px 32px 0 #00000033;
    }

    .seller-info {
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: 32px;
    }

    .seller {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .profile-avatar {
        height: 27px !important;
        width: 27px !important;
    }
</style>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/show.blade.php ENDPATH**/ ?>