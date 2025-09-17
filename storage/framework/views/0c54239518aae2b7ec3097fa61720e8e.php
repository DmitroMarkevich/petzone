<?php $__env->startSection('title', $advert->title); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="advert-container" x-data="advertGallery()">
        <h3 class="page-title">
            <a href="<?php echo e(route('advert.index')); ?>">
                <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">
            </a>
            Повернутись назад
        </h3>

        <div class="advert-main">
            <div class="advert-gallery">
                <div class="advert-slider">
                    <div class="scroll-buttons">
                        <?php if(count($advert->images) > 1): ?>
                            <button class="scroll-btn left" @click="previousImage" x-show="canGoPrevious">
                                <img src="<?php echo e(asset('images/less-than.svg')); ?>" alt="<">
                            </button>
                        <?php endif; ?>

                        <div class="advert-main-image">
                            <img x-bind:src="currentImageSrc" alt="">
                        </div>

                        <?php if(count($advert->images) > 1): ?>
                            <button class="scroll-btn right" @click="nextImage" x-show="canGoNext">
                                <img src="<?php echo e(asset('images/greater-than.svg')); ?>" alt=">">
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="advert-thumbnails">
                    <?php $__currentLoopData = $advert->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <img src="<?php echo e(image_url($img->image_path)); ?>" alt="" @click="setCurrentImage(<?php echo e($index); ?>)"
                             x-bind:class="{ 'active': currentIndex === <?php echo e($index); ?> }">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="advert-info">
                <div class="form-row">
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
                    <span>Size/Weight/Volume, etc</span>
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
                        <button type="submit" class="buy-button">Купити
                            <img src="<?php echo e(asset('images/profile/cart.svg')); ?>" alt="Cart">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="advert-extra">
            <div class="seller-card" x-data="{ showPhone: false, showEmail: false }">
                <div class="seller-header">
                    <img src="<?php echo e(image_url($advert->user->image_path, 'images/default-avatar.png')); ?>"
                         class="seller-avatar" alt="Seller Avatar">
                    <div>
                        <a href="#" class="seller-name">
                            <?php echo e($advert->user->first_name); ?> <?php echo e($advert->user->last_name); ?>

                        </a>
                        <p class="seller-date">Posted: <?php echo e($advert->created_at->format('d/m/Y H:i')); ?></p>
                    </div>
                </div>

                <div x-data="{ modalOpen: false, modalContent: '', copied: false }">
                    <?php if($advert->user->phone): ?>
                        <button class="seller-btn" @click="modalContent = '<?php echo e($advert->user->phone); ?>'; modalOpen = true">
                            Переглянути номер телефону
                        </button>
                    <?php endif; ?>

                    <button class="seller-btn" @click="modalContent = '<?php echo e($advert->user->email); ?>'; modalOpen = true">
                        Показати електрону пошту
                    </button>

                    <div x-show="modalOpen" x-transition class="mobile-search-modal" @click.outside="modalOpen = false" x-cloak>
                        <div class="modal-content">
                            <input type="text" x-model="modalContent" class="modal-input" readonly autofocus>
                            <button type="button" class="modal-search-btn"
                                    @click="navigator.clipboard.writeText(modalContent); copied = true; setTimeout(() => copied = false, 2000)">
                                Скопіювати
                            </button>
                            <button @click="modalOpen = false" class="modal-close-btn">&times;</button>
                            <div x-show="copied" class="copy-success-message"> Текст успішно скопійовано!</div>
                        </div>
                    </div>
                </div>
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
                        <img src="<?php echo e(asset('images/warning.svg')); ?>" alt="Warning">
                    </div>

                    <div class="form-row">
                        <span class="delivery-title">Поскаржитись на товар</span>
                        <span>arrow</span>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!empty($relatedAdverts) && $relatedAdverts->isNotEmpty()): ?>
            <div class="related-adverts" x-data="scrollContainer()" x-init="init()">
                <div class="form-row">
                    <h2 class="section-title">Схожі оголошення</h2>

                    <div class="scroll-buttons">
                        <button @click="scrollLeft()" class="scroll-btn left">
                            <img src="<?php echo e(asset('images/less-than.svg')); ?>" alt="<">
                        </button>

                        <button @click="scrollRight()" class="scroll-btn right">
                            <img src="<?php echo e(asset('images/greater-than.svg')); ?>" alt=">">
                        </button>
                    </div>
                </div>

                <div class="related-adverts-list" x-ref="container">
                    <?php $__currentLoopData = $relatedAdverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginalf74e02aea032995600afb10c96aa9574 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf74e02aea032995600afb10c96aa9574 = $attributes; } ?>
<?php $component = App\View\Components\AdvertCard::resolve(['advert' => $related,'small' => 'true'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdvertCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf74e02aea032995600afb10c96aa9574)): ?>
<?php $attributes = $__attributesOriginalf74e02aea032995600afb10c96aa9574; ?>
<?php unset($__attributesOriginalf74e02aea032995600afb10c96aa9574); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf74e02aea032995600afb10c96aa9574)): ?>
<?php $component = $__componentOriginalf74e02aea032995600afb10c96aa9574; ?>
<?php unset($__componentOriginalf74e02aea032995600afb10c96aa9574); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<script>
    function advertGallery() {
        return {
            currentIndex: 0,
            images: [<?php $__currentLoopData = $advert->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> '<?php echo e(image_url($img->image_path)); ?>', <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> ],

            get currentImageSrc() {
                return this.images[this.currentIndex] || '<?php echo e($advert->main_image); ?>';
            },

            get canGoPrevious() {
                return this.currentIndex > 0;
            },

            get canGoNext() {
                return this.currentIndex < this.images.length - 1;
            },

            setCurrentImage(index) {
                this.currentIndex = index;
            },

            previousImage() {
                if (this.canGoPrevious) {
                    this.currentIndex--;
                }
            },

            nextImage() {
                if (this.canGoNext) {
                    this.currentIndex++;
                }
            }
        }
    }

    function scrollContainer() {
        return {
            scrollStep: 300,
            scrollLeft() {
                this.$refs.container.scrollBy({left: -this.scrollStep, behavior: 'smooth'});
            },
            scrollRight() {
                this.$refs.container.scrollBy({left: this.scrollStep, behavior: 'smooth'});
            }
        }
    }
</script>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/advert/show.blade.php ENDPATH**/ ?>