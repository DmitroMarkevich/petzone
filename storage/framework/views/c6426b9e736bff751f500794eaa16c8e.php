<?php $__env->startSection('content'); ?>
    <div class="auth-container">
        <div class="auth-left">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <img class="navbar-logo" src="<?php echo e(asset('images/white-logo.svg')); ?>" alt="Logo">
            </a>

            <div class="image-slider"
                x-data="{
                currentIndex: 0,
                sliderImages: [
                    { src: '/images/auth/shopping-cart.png', text: '<?php echo e(__('auth.slider.shopping_cart')); ?>' },
                    { src: '/images/auth/carton.png', text: '<?php echo e(__('auth.slider.carton')); ?>' },
                    { src: '/images/auth/receipt.png', text: '<?php echo e(__('auth.slider.receipt')); ?>' }
                ],
                init() {
                    setInterval(() => {
                        this.currentIndex = (this.currentIndex + 1) % this.sliderImages.length;
                    }, 5000);
                }}"
            >
                <div class="slider-frame">
                    <img :src="sliderImages[currentIndex].src" alt="Slider Image" class="slider-image">
                    <p class="tagline" x-text="sliderImages[currentIndex].text"></p>
                </div>

                <div class="slider-dots">
                    <template x-for="(image, index) in sliderImages" :key="index">
                    <span class="dot" :class="{ 'active': currentIndex === index }"></span>
                    </template>
                </div>
            </div>
        </div>

        <div class="auth-right">
            <?php echo $__env->yieldContent('auth-content'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/layouts/auth.blade.php ENDPATH**/ ?>