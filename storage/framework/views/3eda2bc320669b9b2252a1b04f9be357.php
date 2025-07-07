<?php $__env->startSection('profile-content'); ?>
    <?php if($sales->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div class="sales-container">
            <h2 class="page-title">Мої продажі</h2>

            <div class="filter-buttons">
                <button class="filter-button active">Всі</button>
                <button class="filter-button" data-status="pending">Очікують підтвердження</button>
                <button class="filter-button" data-status="confirmed">Підтверджені</button>
                <button class="filter-button" data-status="canceled">Відхилені</button>
            </div>

            <div class="adverts-list">
                <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($order->advert): ?>
                        <?php
                            $status = strtolower($order->status->value);

                            $firstImage = $order->advert->images->first();
                            $imageUrl = $firstImage && $firstImage->image_path
                                ? Storage::disk('s3')->url($firstImage->image_path)
                                : asset('images/advert-test.jpg');
                        ?>

                        <div class="advert-item" data-status="<?php echo e($status); ?>">
                            <div class="advert-left">
                                <div class="advert-image-wrapper">
                                    <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($order->advert->title); ?>"
                                         class="advert-image">
                                </div>

                                <div class="advert-content">
                                    <a class="advert-title" href="<?php echo e(route('adverts.show', $order->advert->id)); ?>">
                                        <?php echo e($order->advert->title); ?>

                                    </a>

                                    <p>Служба доставки: <?php echo e($order->delivery_method); ?></p>

                                    <button type="button" class="toggle-details">Розгорнути</button>
                                </div>


                            </div>

                            <div class="advert-right">
                                <p class="advert-price"><?php echo e($order->advert->price); ?>₴</p>

                                <?php if($order->is_active): ?>
                                    <div class="advert-actions">
                                        <a href class="edit-btn">Підтвердити</a>

                                        <button type="submit" class="delete-btn">Відхилити</button>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="advert-details" style="display: none;">
                                <div>
                                    <p>Покупець</p>
                                    <p>Ім'я <?php echo e($order->buyer->first_name); ?></p>
                                    <p>Прізвище <?php echo e($order->buyer->last_name); ?></p>
                                    <p>Номер Телефону <?php echo e($order->buyer->phone_number); ?></p>
                                </div>

                                <div>
                                    <p>Разом</p>
                                    <p>Ціна <?php echo e($order->total_price); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/profile/toggle-details.js']); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/sales.blade.php ENDPATH**/ ?>