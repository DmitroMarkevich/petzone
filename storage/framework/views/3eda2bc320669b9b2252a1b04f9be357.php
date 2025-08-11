<?php $__env->startSection('title', 'Мої продажі'); ?>

<?php $__env->startSection('profile-content'); ?>
    <?php if($sales->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div class="sales-container">
            <h2 class="page-title">Мої продажі</h2>

            <?php if (isset($component)) { $__componentOriginal4441bf567c34cce16583deb6643469f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4441bf567c34cce16583deb6643469f6 = $attributes; } ?>
<?php $component = App\View\Components\FilterButtons::resolve(['items' => $sales->getCollection(),'filters' => [
                ['key' => 'status', 'value' => 'PENDING', 'label' => 'Очікують підтвердження'],
                ['key' => 'status', 'value' => 'CONFIRMED', 'label' => 'Підтверджені'],
                ['key' => 'status', 'value' => 'CANCELED', 'label' => 'Відхилені']
            ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filter-buttons'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FilterButtons::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4441bf567c34cce16583deb6643469f6)): ?>
<?php $attributes = $__attributesOriginal4441bf567c34cce16583deb6643469f6; ?>
<?php unset($__attributesOriginal4441bf567c34cce16583deb6643469f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4441bf567c34cce16583deb6643469f6)): ?>
<?php $component = $__componentOriginal4441bf567c34cce16583deb6643469f6; ?>
<?php unset($__componentOriginal4441bf567c34cce16583deb6643469f6); ?>
<?php endif; ?>

            <div class="adverts-list">
                <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(!$order->advert) continue; ?>

                    <div class="advert-item" data-status="<?php echo e($order->status->value); ?>">
                        <div class="advert-left">
                            <div class="advert-image-wrapper">
                                <img src="<?php echo e($order->advert_main_image_url); ?>" alt="<?php echo e($order->advert->title); ?>"
                                     class="advert-image">
                            </div>

                            <div class="advert-content">
                                <a class="advert-title" href="<?php echo e(route('adverts.show', $order->advert->id)); ?>">
                                    <?php echo e($order->advert->title); ?>

                                </a>

                                <p>Служба доставки: <?php echo e(\App\Enum\DeliveryMethod::getTranslation($order->delivery_method)); ?></p>

                                <button type="button" class="toggle-details">Розгорнути</button>
                            </div>
                        </div>

                        <div class="advert-right">
                            <p class="advert-price"><?php echo e($order->advert->price); ?>₴</p>

                            <?php if($order->status->value == \App\Enum\OrderStatus::PENDING->value): ?>
                                <div class="advert-actions">
                                    <form action="<?php echo e(route('profile.sales.confirm', $order->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('POST'); ?>
                                        <button type="submit" class="edit-btn">Підтвердити</button>
                                    </form>

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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p>Продажі відсутні.</p>
                <?php endif; ?>

                <?php if($sales->hasPages()): ?>
                    <?php echo e($sales->links()); ?>

                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/sales.blade.php ENDPATH**/ ?>