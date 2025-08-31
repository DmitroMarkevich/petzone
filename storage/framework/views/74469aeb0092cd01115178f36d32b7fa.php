<?php $__env->startSection('title', $advert->title); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="advert-container">
        <div class="breadcrumb">
            <a href="<?php echo e(route('profile.adverts')); ?>" class="back-link">
                <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">Назад
            </a>
            <span>/ Dogs / Food / Vitamins</span>
        </div>

        <div class="advert-main">
            <div class="advert-gallery">
                <div class="advert-slider">
                    <div class="scroll-buttons">
                        <?php if(count($advert->images) > 1): ?>
                            <button class="scroll-btn left">
                                <img src="<?php echo e(asset('images/less-than.svg')); ?>" alt="<">
                            </button>
                        <?php endif; ?>

                        <div class="advert-main-image">
                            <img id="mainImage" src="<?php echo e($advert->main_image); ?>" alt="">
                        </div>

                        <?php if(count($advert->images) > 1): ?>
                            <button class="scroll-btn right">
                                <img src="<?php echo e(asset('images/greater-than.svg')); ?>" alt=">">
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="advert-thumbnails">
                    <?php $__currentLoopData = $advert->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(image_url($img->image_path)); ?>" alt="">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="advert-info">
                <div class="form-row">
                    <div class="advert-rating">
                        <span class="rating-value"><?php echo e($advert->average_rating); ?></span>
                        <div>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <img src="<?php echo e(asset('images/star.svg')); ?>"
                                     alt="<?php echo e($i <= $advert->average_rating ? 'Star' : 'Empty Star'); ?>">
                            <?php endfor; ?>
                        </div>
                    </div>
                    <button class="wishlist-btn">
                        <img src="<?php echo e(asset('images/heart.svg')); ?>" alt="Add to favorites">
                    </button>
                </div>

                <div>
                    <h2 class="advert-title"><?php echo e($advert->title); ?></h2>
                    <p class="advert-description"><?php echo e($advert->description); ?></p>
                </div>

                <div class="advert-tags">
                    <?php $__currentLoopData = $tags ?? ['Собаки', 'Їжа', "Здоров'я"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="tag">#<?php echo e($tag); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div>
                    <h3 class="advert-subtitle">Options:</h3>
                    <p class="advert-text">Size/Weight/Volume, etc</p>
                </div>

                <div class="form-row" style="margin-top: auto">
                    <div class="advert-price">
                        <?php if($advert->shouldShowDiscountPrice()): ?>
                            <span class="old-price"><?php echo e(number_format($advert->previous_price)); ?> ₴</span>
                            <h4 class="new-price"><?php echo e(number_format($advert->price)); ?> ₴</h4>
                        <?php else: ?>
                            <span class="current-price"><?php echo e(number_format($advert->price)); ?> ₴</span>
                        <?php endif; ?>
                    </div>

                    <form action="<?php echo e(route('checkout.select')); ?>" method="POST" style="display: inline">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="advert_id" value="<?php echo e($advert->id); ?>">
                        <button type="submit" class="buy-button">
                            Купити <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="advert-extra">
            <div class="seller-card">
                <div class="seller-header">
                    <img src="<?php echo e($avatarUrl); ?>" class="seller-avatar" alt="Seller Avatar">
                    <div>
                        <a href="#" class="seller-name">
                            <?php echo e($advert->user->first_name); ?> <?php echo e($advert->user->last_name); ?>

                        </a>
                        <p class="seller-date">Posted: <?php echo e($advert->created_at->format('d/m/Y H:i')); ?></p>
                    </div>
                </div>

                <button class="seller-btn">View number</button>
                <button class="seller-btn">View Email</button>
            </div>

            <div class="delivery-card">
                <h3 class="advert-subtitle">Delivery methods</h3>

                <div class="delivery-item">
                    <div class="delivery-content">
                        <span class="delivery-subtitle"># todo</span>
                    </div>
                </div>

                <div class="delivery-item complaint">
                    <div class="delivery-icon">
                        <img src="<?php echo e(asset('images/warning.svg')); ?>" alt="Warning" width="20" height="20">
                    </div>
                    <div class="form-row" style="width: 100%">
                        <span class="delivery-title">Поскаржитись на товар</span>
                        <span>arrow</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .delivery-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
        }

        .delivery-item.complaint {
            border-top: 1px solid #f0f0f0;
            margin-top: 8px;
            padding-top: 20px;
        }

        .advert-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .advert-main {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
        }

        .advert-slider {
            position: relative;

            .scroll-btn {
                position: absolute;
                top: 50%;
            }

            .scroll-btn.left { left: 10px; }
            .scroll-btn.right { right: 10px; }
        }

        .advert-main-image {
            flex: 1;

            img {
                width: 100%;
                height: 500px;
                object-fit: contain;
                border-radius: 16px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            }
        }

        .advert-thumbnails {
            display: flex;
            gap: 12px;
        }

        .advert-thumbnails img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .advert-thumbnails img:hover {
            opacity: 0.8;
        }

        .advert-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
        }

        .advert-description {
            color: #555;
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
        }

        .advert-subtitle {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .advert-text {
            color: #666;
        }

        .advert-extra {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin-top: 40px;
        }

        .seller-card, .delivery-card {
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .seller-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .seller-name {
            font-weight: 600;
            text-decoration: none;
            color: #333;
        }

        .seller-name:hover {
            text-decoration: underline;
        }

        .seller-date {
            font-size: 13px;
            color: #777;
        }

        .seller-btn {
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background: #fff;
            cursor: pointer;
            transition: background 0.2s ease;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .advert-main, .advert-extra {
                grid-template-columns: 1fr;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/show.blade.php ENDPATH**/ ?>