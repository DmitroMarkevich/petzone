<?php
    use App\Enum\PaymentMethod;
?>



<?php $__env->startSection('content'); ?>
    <div class="checkout-layout">
        <header class="checkout-header">
            <img src="<?php echo e(asset('images/blue-logo.svg')); ?>" alt="Logo">
        </header>

        <main>
            <form action="<?php echo e(route('checkout.store')); ?>" method="POST" class="checkout-container">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="advert_id" value="<?php echo e($advert->id); ?>">

                <div class="checkout-details">
                    <h1>Оформлення замовлення</h1>

                    <div class="container-item">
                        <h2>Замовлення</h2>
                        <p>Продавець: <?php echo e($advert->user->first_name); ?> <?php echo e($advert->user->last_name); ?></p>
                        <?php if (isset($component)) { $__componentOriginal4b7b31bf8150596c2e9ef372392491c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b7b31bf8150596c2e9ef372392491c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.advert-item','data' => ['advert' => $advert]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['advert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b7b31bf8150596c2e9ef372392491c5)): ?>
<?php $attributes = $__attributesOriginal4b7b31bf8150596c2e9ef372392491c5; ?>
<?php unset($__attributesOriginal4b7b31bf8150596c2e9ef372392491c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b7b31bf8150596c2e9ef372392491c5)): ?>
<?php $component = $__componentOriginal4b7b31bf8150596c2e9ef372392491c5; ?>
<?php unset($__componentOriginal4b7b31bf8150596c2e9ef372392491c5); ?>
<?php endif; ?>
                    </div>

                    <div class="container-item">
                        <h3>Доставка</h3>

                        <label for="NOVA_POST_SELF_PICKUP" class="delivery-method">
                            <div class="delivery-header">
                                <span class="radio-label">
                                    <input type="radio" id="NOVA_POST_SELF_PICKUP" name="delivery_method"
                                           value="NOVA_POST_SELF_PICKUP">
                                    <span class="delivery-name"><?php echo e(__('delivery.NOVA_POST_SELF_PICKUP')); ?></span>
                                </span>

                                <span class="delivery-price">50 грн</span>
                            </div>

                            <div class="delivery-extra hidden" id="nova-post-extra">
                                <input type="text" class="dropdown-input" placeholder="Виберіть відповідне відділення"
                                       id="mainInput">

                                <ul class="dropdown-panel" id="nova-post-branch"></ul>
                            </div>
                        </label>

                        <label for="MEEST_SELF_PICKUP" class="delivery-method">
                            <input type="radio" id="MEEST_SELF_PICKUP" name="delivery_method" value="MEEST_SELF_PICKUP">
                            <?php echo e(__('delivery.MEEST_SELF_PICKUP')); ?>


                            <div class="delivery-extra hidden">
                                <input type="text" class="dropdown-input" placeholder="Виберіть відповідне відділення"
                                       id="mainInput">

                                <ul class="dropdown-panel">
                                    <li class="dropdown-item">№22003, вул. Курортна, 2</li>
                                    <li class="dropdown-item">№22004, вул. Центральна, 5</li>
                                    <li class="dropdown-item">№22005, вул. Лісова, 10</li>
                                </ul>
                            </div>
                        </label>

                        <label for="NOVA_POST_COURIER" class="delivery-method">
                            <input type="radio" id="NOVA_POST_COURIER" name="delivery_method" value="NOVA_POST_COURIER">
                            <?php echo e(__('delivery.NOVA_POST_COURIER')); ?>


                            <div class="delivery-extra hidden">
                                <input type="text" placeholder="Вулиця" value="Соборності">
                                <input type="text" placeholder="Будинок" value="12">
                                <input type="text" placeholder="Квартира" value="1">
                            </div>
                        </label>

                        <label for="MEEST_COURIER" class="delivery-method">
                            <input type="radio" id="MEEST_COURIER" name="delivery_method" value="MEEST_COURIER">
                            <?php echo e(__('delivery.MEEST_COURIER')); ?>


                            <div class="delivery-extra hidden">
                                <input type="text" placeholder="Вулиця" value="Соборності">
                                <input type="text" placeholder="Будинок" value="12">
                                <input type="text" placeholder="Квартира" value="1">
                            </div>
                        </label>

                        <label for="SELF_PICKUP" class="delivery-method">
                            <input type="radio" id="SELF_PICKUP" name="delivery_method" value="SELF_PICKUP">
                            <?php echo e(__('delivery.SELF_PICKUP')); ?>

                        </label>
                    </div>

                    <div class="container-item">
                        <h3>Оплата</h3>

                        <?php $__currentLoopData = PaymentMethod::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'payment_method','id' => ''.e($method->value).'','value' => ''.e($method->value).'','label' => ''.e(PaymentMethod::getTranslation($method)).'','class' => 'payment-method']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'payment_method','id' => ''.e($method->value).'','value' => ''.e($method->value).'','label' => ''.e(PaymentMethod::getTranslation($method)).'','class' => 'payment-method']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale892edd1d52b28f8c510669e168e9b66)): ?>
<?php $attributes = $__attributesOriginale892edd1d52b28f8c510669e168e9b66; ?>
<?php unset($__attributesOriginale892edd1d52b28f8c510669e168e9b66); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale892edd1d52b28f8c510669e168e9b66)): ?>
<?php $component = $__componentOriginale892edd1d52b28f8c510669e168e9b66; ?>
<?php unset($__componentOriginale892edd1d52b28f8c510669e168e9b66); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="container-item">
                        <h3>Отримувач</h3>

                        <div class="profile-header">
                            <span class="profile-name"><?php echo e("$user->first_name $user->last_name"); ?></span>
                            <a class="link-edit">Змінити</a>
                        </div>

                        <div class="profile-section" id="contact-info" hidden>
                            <div class="form-row">
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','name' => 'first_name','label' => 'Ім\'я','value' => ''.e($user->first_name).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'first_name','label' => 'Ім\'я','value' => ''.e($user->first_name).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','name' => 'last_name','label' => 'Прізвище','value' => ''.e($user->last_name).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'last_name','label' => 'Прізвище','value' => ''.e($user->last_name).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','name' => 'patronymic','label' => 'По батькові']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'patronymic','label' => 'По батькові']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'tel','name' => 'phone_number','label' => 'Номер телефону','value' => ''.e($user->phone_number).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'tel','name' => 'phone_number','label' => 'Номер телефону','value' => ''.e($user->phone_number).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                                </div>
                            </div>

                            <div class="profile-actions">
                                <button class="btn-change" id="save-btn">Зберегти</button>
                                <button class="btn-cancel" id="cancel-btn">Скасувати</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-summary">
                    <h4 class="summary-title">Разом</h4>

                    <div class="order-total">
                        <div class="form-row">
                            <p>Товар на суму</p>
                            <p class="advert-price"><?php echo e($advert->price); ?>₴</p>
                        </div>

                        <div class="form-row">
                            <p>Вартість доставки</p>
                            <span>Безкоштовно</span>
                        </div>
                    </div>

                    <button type="submit" class="order-button">Замовлення підтверджую</button>

                    <p class="order-info">
                        Отримання замовлення від 5 000 ₴ - 30 000 ₴ за наявності документів.
                        При оплаті готівкою від 30 000 ₴ необхідно надати документи для верифікації
                        згідно вимог Закону України від 06.12.2019 №361-IX
                    </p>

                    <div class="order-terms">
                        <p class="terms-title">Підтверджуючи замовлення, я приймаю умови:</p>
                        <ul class="terms-list">
                            <li><a href="#" class="terms-link">Положення про обробку персональних даних.</a></li>
                            <li><a href="#" class="terms-link">Угоди користувача.</a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </main>

        <footer class="checkout-footer">
            <p>PetZone © 2024 Всі права захищені</p>
        </footer>
    </div>

    <?php if($errors->has('delivery_method')): ?>
        <div class="error-message">
            <?php echo e($errors->first('delivery_method')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/checkout/index.js']); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/checkout/index.blade.php ENDPATH**/ ?>