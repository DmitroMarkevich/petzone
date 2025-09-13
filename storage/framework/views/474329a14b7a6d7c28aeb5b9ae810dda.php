<?php $__env->startSection('title', 'Оформлення замовлення'); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="checkout-layout" x-data="checkoutForm()">
        <form action="<?php echo e(route('checkout.store')); ?>" method="POST" class="checkout-container">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="advert_id" value="<?php echo e($advert->id); ?>">

            <div class="checkout-details">
                <h1>Оформлення замовлення</h1>

                <div class="container-item">
                    <h2>Замовлення</h2>
                    <?php if (isset($component)) { $__componentOriginalb462f209552f33171c7094020d950465 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb462f209552f33171c7094020d950465 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.advert.item','data' => ['advert' => $advert]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['advert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb462f209552f33171c7094020d950465)): ?>
<?php $attributes = $__attributesOriginalb462f209552f33171c7094020d950465; ?>
<?php unset($__attributesOriginalb462f209552f33171c7094020d950465); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb462f209552f33171c7094020d950465)): ?>
<?php $component = $__componentOriginalb462f209552f33171c7094020d950465; ?>
<?php unset($__componentOriginalb462f209552f33171c7094020d950465); ?>
<?php endif; ?>
                </div>

                <div class="container-item" x-data="deliveryMethods()">
                    <h3>Доставка</h3>

                    <label for="NOVA_POST_SELF_PICKUP" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="NOVA_POST_SELF_PICKUP"
                                       name="delivery_method"
                                       value="NOVA_POST_SELF_PICKUP"
                                       x-model="selectedMethod">
                                <span class="delivery-name"><?php echo e(__('delivery.NOVA_POST_SELF_PICKUP')); ?></span>
                            </span>
                            <span class="delivery-price">50 грн</span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'NOVA_POST_SELF_PICKUP'">
                            <input type="text" class="dropdown-input" placeholder="Виберіть відповідне відділення">
                            <ul class="dropdown-panel" id="nova-post-branch"></ul>
                        </div>
                    </label>

                    <label for="MEEST_SELF_PICKUP" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="MEEST_SELF_PICKUP"
                                       name="delivery_method"
                                       value="MEEST_SELF_PICKUP"
                                       x-model="selectedMethod">
                                <span class="delivery-name"><?php echo e(__('delivery.MEEST_SELF_PICKUP')); ?></span>
                            </span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'MEEST_SELF_PICKUP'">
                            <input type="text" class="dropdown-input" placeholder="Виберіть відповідне відділення">
                            <ul class="dropdown-panel">
                                <li class="dropdown-item">№22003, вул. Курортна, 2</li>
                                <li class="dropdown-item">№22004, вул. Центральна, 5</li>
                                <li class="dropdown-item">№22005, вул. Лісова, 10</li>
                            </ul>
                        </div>
                    </label>

                    <label for="NOVA_POST_COURIER" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="NOVA_POST_COURIER"
                                       name="delivery_method"
                                       value="NOVA_POST_COURIER"
                                       x-model="selectedMethod">
                                <span class="delivery-name"><?php echo e(__('delivery.NOVA_POST_COURIER')); ?></span>
                            </span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'NOVA_POST_COURIER'">
                            <input type="text" placeholder="Вулиця" value="Соборності">
                            <input type="text" placeholder="Будинок" value="12">
                            <input type="text" placeholder="Квартира" value="1">
                        </div>
                    </label>

                    <label for="MEEST_COURIER" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="MEEST_COURIER"
                                       name="delivery_method"
                                       value="MEEST_COURIER"
                                       x-model="selectedMethod">
                                <span class="delivery-name"><?php echo e(__('delivery.MEEST_COURIER')); ?></span>
                            </span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'MEEST_COURIER'">
                            <input type="text" placeholder="Вулиця" value="Соборності">
                            <input type="text" placeholder="Будинок" value="12">
                            <input type="text" placeholder="Квартира" value="1">
                        </div>
                    </label>

                    <label for="SELF_PICKUP" class="delivery-method">
                        <input type="radio"
                               id="SELF_PICKUP"
                               name="delivery_method"
                               value="SELF_PICKUP"
                               x-model="selectedMethod">
                        <?php echo e(__('delivery.SELF_PICKUP')); ?>

                    </label>
                </div>

                <div class="container-item">
                    <h3>Оплата</h3>

                    <?php $__currentLoopData = \App\Enum\PaymentMethod::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if (isset($component)) { $__componentOriginald6e5394b6cfe1adb61a7b141fc425092 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald6e5394b6cfe1adb61a7b141fc425092 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.radio-button','data' => ['name' => 'payment_method','id' => ''.e($method->value).'','value' => ''.e($method->value).'','label' => ''.e(\App\Enum\PaymentMethod::getTranslation($method)).'','class' => 'payment-method']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.radio-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'payment_method','id' => ''.e($method->value).'','value' => ''.e($method->value).'','label' => ''.e(\App\Enum\PaymentMethod::getTranslation($method)).'','class' => 'payment-method']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald6e5394b6cfe1adb61a7b141fc425092)): ?>
<?php $attributes = $__attributesOriginald6e5394b6cfe1adb61a7b141fc425092; ?>
<?php unset($__attributesOriginald6e5394b6cfe1adb61a7b141fc425092); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald6e5394b6cfe1adb61a7b141fc425092)): ?>
<?php $component = $__componentOriginald6e5394b6cfe1adb61a7b141fc425092; ?>
<?php unset($__componentOriginald6e5394b6cfe1adb61a7b141fc425092); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="container-item">
                    <h3>Отримувач</h3>

                    <div class="profile-header" x-show="!editing">
                        <span class="profile-name" x-text="displayName"></span>
                        <a class="link-edit" @click="startEdit">Змінити</a>
                    </div>

                    <div class="profile-section" x-show="editing" x-transition>
                        <div class="form-row">
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'recipient_first_name','label' => 'Ім\'я','xModel' => 'form.recipient_first_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'recipient_first_name','label' => 'Ім\'я','x-model' => 'form.recipient_first_name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'recipient_last_name','label' => 'Прізвище','xModel' => 'form.recipient_last_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'recipient_last_name','label' => 'Прізвище','x-model' => 'form.recipient_last_name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'recipient_middle_name','label' => 'По батькові','xModel' => 'form.recipient_middle_name']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'recipient_middle_name','label' => 'По батькові','x-model' => 'form.recipient_middle_name']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                            </div>
                            <div class="form-group">
                                <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'tel','name' => 'recipient_phone_number','label' => 'Номер телефону','xModel' => 'form.recipient_phone_number']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'tel','name' => 'recipient_phone_number','label' => 'Номер телефону','x-model' => 'form.recipient_phone_number']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                            </div>
                        </div>

                        <div class="profile-actions">
                            <button class="btn-change" type="button" @click="saveChanges">Зберегти</button>
                            <button class="btn-cancel" type="button" @click="cancelEdit">Скасувати</button>
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
    </div>

    <?php if($errors->has('delivery_method')): ?>
        <div class="error-message">
            <?php echo e($errors->first('delivery_method')); ?>

        </div>
    <?php endif; ?>

    <script>
        function deliveryMethods() {
            return {
                selectedMethod: ''
            }
        }

        function checkoutForm() {
            return {
                editing: false,
                form: {
                    recipient_first_name: '<?php echo e($user->first_name); ?>',
                    recipient_last_name: '<?php echo e($user->last_name); ?>',
                    recipient_middle_name: '',
                    recipient_phone_number: '<?php echo e($user->phone_number); ?>'
                },
                original: {
                    recipient_first_name: '<?php echo e($user->first_name); ?>',
                    recipient_last_name: '<?php echo e($user->last_name); ?>',
                    recipient_middle_name: '',
                    recipient_phone_number: '<?php echo e($user->phone_number); ?>'
                },

                get displayName() {
                    const first = this.form.recipient_first_name || '';
                    const last = this.form.recipient_last_name || '';
                    return `${first} ${last}`.trim();
                },

                startEdit() {
                    this.editing = true;
                },

                saveChanges() {
                    // Оновлюємо оригінальні дані
                    this.original = { ...this.form };
                    this.editing = false;
                },

                cancelEdit() {
                    // Відновлюємо оригінальні дані
                    this.form = { ...this.original };
                    this.editing = false;
                }
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/checkout/index.blade.php ENDPATH**/ ?>