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
                ],'currentFilter' => request('status')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php if(!$sale->advert) continue; ?>

                    <div class="advert-item" data-status="<?php echo e($sale->status->value); ?>">
                        <div class="advert-main">
                            <div class="advert-left">
                                <div class="advert-image-wrapper">
                                    <img src="<?php echo e($sale->advert->main_image); ?>" class="advert-image"
                                         alt="<?php echo e($sale->advert->title); ?>">
                                </div>

                                <div class="advert-content">
                                    <a class="advert-title" href="<?php echo e(route('adverts.show', $sale->advert->id)); ?>">
                                        <?php echo e($sale->advert->title); ?>

                                    </a>

                                    <p>Служба доставки:
                                        <img src="<?php echo e(\App\Enum\DeliveryMethod::getIcon($sale->delivery_method)); ?>"
                                             alt="Delivery" class="delivery-icon">
                                        <?php echo e(\App\Enum\DeliveryMethod::getTranslation($sale->delivery_method)); ?>

                                    </p>

                                    <div class="advert-date-wrapper">
                                        <img src="<?php echo e(asset('images/profile/calendar.svg')); ?>" alt="Calendar">
                                        <span class="advert-date"><?php echo e($sale->created_at->format('d.m.y, H:i')); ?></span>
                                    </div>

                                    <button type="button" class="toggle-details">Розгорнути</button>
                                </div>
                            </div>

                            <div class="advert-right">
                                <p class="advert-price"><?php echo e($sale->total_price); ?>₴</p>

                                <?php if($sale->status->value == \App\Enum\OrderStatus::PENDING->value): ?>
                                    <div class="advert-actions">
                                        <form action="<?php echo e(route('profile.sales.confirm', $sale->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="edit-btn">Підтвердити</button>
                                        </form>

                                        <form action="<?php echo e(route('profile.sales.reject', $sale->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="delete-btn">Відхилити</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="advert-details">
                            <div class="details-section">
                                <h4 class="details-title">Інформація про покупця</h4>
                                <div class="details-list">
                                    <div>
                                        <span>Покупець:</span>
                                        <a href="<?php echo e(route('home')); ?>" title="Перейти до профілю покупця">
                                            <?php echo e($sale->buyer->first_name); ?> <?php echo e($sale->buyer->last_name); ?>

                                        </a>
                                    </div>
                                    <span>Ім'я: <?php echo e($sale->recipient->first_name); ?></span>
                                    <span>Прізвище: <?php echo e($sale->recipient->last_name); ?></span>
                                    <span>По батькові: <?php echo e($sale->recipient->middle_name); ?></span>
                                    <span>Телефон: <?php echo e($sale->recipient->phone_number); ?></span>
                                </div>
                            </div>
                            <div class="details-section">
                                <h4 class="details-title">Деталі замовлення</h4>
                                <div class="details-list">
                                    <span>Статус: <?php echo e($sale->status); ?></span>
                                    <span>ID угоди: <?php echo e($sale->order_number); ?></span>
                                    <span>Комісія: 2% + 20₴</span>
                                    <span>До зарахування: <?php echo e($sale->total_price); ?> ₴</span>
                                </div>
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


<style>
    .advert-details {
        display: none;
    }

    .advert-details.active {
        display: grid;
    }

    .advert-details {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;

        background: #fff;
        border-radius: 12px;
        padding: 20px 30px;
        margin-bottom: 10px;
        font-family: 'Inter', 'sans-serif';
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .details-section {
        display: flex;
        flex-direction: column;
        color: #1C1B1C;

        .details-title {
            padding-bottom: 10px;
            margin-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .details-list {
            display: grid;
            gap: 8px;
        }
    }

    .advert-details a:hover {
        text-decoration: underline;
    }

    .delivery-icon {
        width: 20px;
        height: auto;
        vertical-align: middle;
    }

    @media (max-width: 768px) {
        .advert-details {
            grid-template-columns: 1fr;
            padding: 15px 20px;
        }
    }
</style>

<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/sales.blade.php ENDPATH**/ ?>