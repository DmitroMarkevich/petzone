<?php $__env->startSection('title', 'Деталі замовлення'); ?>

<?php $__env->startSection('profile-content'); ?>
    <div class="record-container">
        <h2 class="page-title">
            <a href="<?php echo e(route('profile.orders.index')); ?>">
                <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">
            </a>
            Деталі замовлення
        </h2>

        <div class="order-details">
            <div class="order-container">
                <div class="order-header">
                    <span>Замовлення</span>
                    <span>Кількість</span>
                    <span>Статус відправлення</span>
                    <span>Номер</span>
                    <span>Ціна</span>
                </div>

                <div class="order-item-row">
                    <div class="order-item-info">
                        <img class="order-image" src="<?php echo e($order->advert->mainImage); ?>"
                             alt="<?php echo e($order->advert->title); ?>">

                        <div class="order-item-details">
                            <h4><?php echo e($order->advert->title); ?></h4>
                            <p>Spiky Beef</p>
                        </div>
                    </div>

                    <span>1</span>
                    <div class="status <?php echo e(strtolower($order->status->value)); ?>">
                        <?php echo e(\App\Enum\OrderStatus::getTranslation($order->status)); ?>

                    </div>
                    <span><?php echo e($order->tracking_number ?? __('N/A')); ?></span>
                    <span>₴<?php echo e($order->total_price); ?></span>
                </div>
            </div>

            <div class="form-row">
                <div class="contact-details">
                    <h3 class="section-heading">Адреса доставки</h3>
                    <p>Київ, Відділення №32</p>
                    <p>вул. Набережно-Хрещатицька, 33</p>
                </div>

                <a href="https://www.google.com/maps/search/?api=1&query=Київ, Відділення №32, вул. Набережно-Хрещатицька, 33"
                   class="link-icon">
                    <img src="<?php echo e(asset('images/location-pin.svg')); ?>" alt="">Подивитися в Google Maps
                </a>
            </div>

            <div class="form-row">
                <div class="contact-details">
                    <h3 class="section-heading">Відправник</h3>
                    <p><?php echo e("{$order->seller->last_name} {$order->seller->first_name}"); ?></p>
                    <p><?php echo e($order->seller->phone_number ?? 'N/A'); ?></p>
                </div>
                <?php if($order->seller->phone_number): ?>
                    <a href="tel:<?php echo e($order->seller->phone_number); ?>" class="link-icon">
                        <img src="<?php echo e(asset('images/contact-phone.svg')); ?>" alt="">Подзвонити
                    </a>
                <?php endif; ?>
            </div>

            <div class="contact-details">
                <h3 class="section-heading">Одержувач</h3>
                <p><?php echo e("{$order->recipient_first_name} {$order->recipient_last_name} {$order->recipient_middle_name}"); ?></p>
                <p><?php echo e($order->recipient_phone); ?></p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views\profile\orders\show.blade.php ENDPATH**/ ?>