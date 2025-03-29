<?php $__env->startSection('content'); ?>
    <div class="checkout-layout">
        <header class="checkout-header">
            <img src="<?php echo e(asset('images/blue-logo.svg')); ?>" alt="Logo">
        </header>

        <main class="checkout-container">
            <div class="checkout-details">
                <div class="checkout-section">
                    <h1>Оформлення замовлення</h1>

                    <div class="container-item">
                        <h2>Замовлення</h2>
                        <p>Продавець: <?php echo e("$owner->first_name $owner->last_name"); ?></p>
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

                        <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'delivery_method','label' => 'Самовивіз з Нової Пошти','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'delivery_method','label' => 'Самовивіз з Нової Пошти','checked' => true]); ?>
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
                        <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'delivery_method','label' => 'Самовивіз з Meest']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'delivery_method','label' => 'Самовивіз з Meest']); ?>
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
                        <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'delivery_method','label' => 'Кур\'єр з Нової Пошти']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'delivery_method','label' => 'Кур\'єр з Нової Пошти']); ?>
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
                        <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'delivery_method','label' => 'Кур\'єр з Meest']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'delivery_method','label' => 'Кур\'єр з Meest']); ?>
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
                    </div>

                    <div class="container-item">
                        <h3>Оплата</h3>

                        <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'payment','label' => 'Оплата під час отримання товару','checked' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'payment','label' => 'Оплата під час отримання товару','checked' => true]); ?>
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
                        <?php if (isset($component)) { $__componentOriginale892edd1d52b28f8c510669e168e9b66 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale892edd1d52b28f8c510669e168e9b66 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.radio-button','data' => ['name' => 'payment','label' => 'Оплатити зараз']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'payment','label' => 'Оплатити зараз']); ?>
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
                    </div>

                    <div class="container-item">
                        <h3>Отримувач</h3>

                        <div class="profile-header">
                            <span class="profile-name"><?php echo e("$user->first_name $user->last_name"); ?></span>
                            <a href="#" class="link-edit">Змінити</a>
                        </div>

                        <div class="profile-section" id="contact-info" style="display: none">
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'email','name' => 'email','label' => 'Електронна адреса','value' => ''.e($user->email).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'email','label' => 'Електронна адреса','value' => ''.e($user->email).'']); ?>
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
            </div>

            <div class="checkout-summary">
                <h4 class="summary-title">Разом</h4>

                <div class="order-total">
                    <div class="form-row">
                        <p>Товар на суму</p>
                        <span class="advert-price"><?php echo e($advert->price); ?>₴</span>
                    </div>

                    <div class="form-row">
                        <p>Вартість доставки</p>
                        <span>Безкоштовно</span>
                    </div>
                </div>

                <form action="<?php echo e(route('checkout.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="advert_id" value="<?php echo e($advert->id); ?>">
                    <input type="hidden" name="delivery_method" id="delivery-method" value="Самовивіз з Нової Пошти">

                    <button type="submit" class="order-button">Замовлення підтверджую</button>
                </form>

                <p class="order-info">
                    Отримання замовлення від 5 000 ₴ - 30 000 ₴ за наявності документів.
                    При оплаті готівкою від 30 000 ₴ необхідно надати документи для верифікації
                    згідно вимог Закону України від 06.12.2019 №361-IX
                </p>

                <div class="order-terms">
                    <p class="terms-title">Підтверджуючи замовлення, я приймаю умови:</p>
                    <ul class="terms-list">
                        <li><a href="#" class="terms-link">положення про обробку персональних даних</a></li>
                        <li><a href="#" class="terms-link">угоди користувача</a></li>
                    </ul>
                </div>
            </div>
        </main>

        <footer class="checkout-footer">
            <p>PetZone © 2024 Всі права захищені</p>
        </footer>
    </div>
<?php $__env->stopSection(); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/checkout/index.js']); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/checkout/index.blade.php ENDPATH**/ ?>