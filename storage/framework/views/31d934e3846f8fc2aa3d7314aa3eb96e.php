<?php $__env->startSection('title', 'Зареєструватися'); ?>

<?php $__env->startSection('auth-content'); ?>
    <div class="auth-content" x-data="registrationForm()" x-init="init()">
        <div class="auth-header">
            <h2 class="auth-heading"><?php echo e(__('auth.register.heading')); ?></h2>
            <p class="auth-subheading"><?php echo e(__('auth.register.subheading')); ?></p>
        </div>

        <form id="registration-form" method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="step" x-show="step === 1" x-cloak>
                <div class="form-group">
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'email','name' => 'email','xRef' => 'email','label' => ''.e(__('auth.register.email')).'','placeholder' => 'Email','dataValidation' => 'email','@input' => 'validateStepOne()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'email','x-ref' => 'email','label' => ''.e(__('auth.register.email')).'','placeholder' => 'Email','data-validation' => 'email','@input' => 'validateStepOne()']); ?>
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

                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'password','name' => 'password','xRef' => 'password','label' => ''.e(__('auth.register.password')).'','placeholder' => '********','dataValidation' => 'password','@input' => 'validateStepOne()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','name' => 'password','x-ref' => 'password','label' => ''.e(__('auth.register.password')).'','placeholder' => '********','data-validation' => 'password','@input' => 'validateStepOne()']); ?>
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

                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'password','name' => 'password_confirmation','xRef' => 'passwordConfirmation','label' => ''.e(__('auth.register.password_confirmation')).'','placeholder' => '********','dataValidation' => 'password','@input' => 'validateStepOne()']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'password','name' => 'password_confirmation','x-ref' => 'passwordConfirmation','label' => ''.e(__('auth.register.password_confirmation')).'','placeholder' => '********','data-validation' => 'password','@input' => 'validateStepOne()']); ?>
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

                <div>
                    <button type="button" class="button next-step" @click="nextStep()">
                        <?php echo e(__('auth.register.next')); ?>

                    </button>
                    <?php echo $__env->make('components.partials.social-buttons', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <div class="auth-link">
                    <p><?php echo e(__('auth.register.login_text')); ?>

                        <a href="<?php echo e(route('login')); ?>"><?php echo e(__('auth.register.login_link')); ?></a>
                    </p>
                </div>
            </div>

            <div class="step" x-show="step === 2" x-cloak>
                <div class="photo-upload" @click="triggerFileInput">
                    <div class="photo-background" :style="photoStyle">
                        <img x-show="!hasFile" src="<?php echo e(asset('images/auth/upload-photo.svg')); ?>" alt="Upload photo">
                    </div>
                    <input id="profile-photo" type="file" name="logo" accept=".jpeg,.png,.jpg,.svg" hidden @change="fileChanged">
                </div>

                <div class="form-group">
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'first_name','label' => ''.e(__('auth.register.first_name')).'','placeholder' => ''.e(__('auth.register.first_name_placeholder')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'first_name','label' => ''.e(__('auth.register.first_name')).'','placeholder' => ''.e(__('auth.register.first_name_placeholder')).'']); ?>
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

                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'last_name','label' => ''.e(__('auth.register.last_name')).'','placeholder' => ''.e(__('auth.register.last_name_placeholder')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'last_name','label' => ''.e(__('auth.register.last_name')).'','placeholder' => ''.e(__('auth.register.last_name_placeholder')).'']); ?>
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

                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'tel','name' => 'phone_number','label' => ''.e(__('auth.register.phone_number')).'','placeholder' => ''.e(__('auth.register.phone_number_placeholder')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'tel','name' => 'phone_number','label' => ''.e(__('auth.register.phone_number')).'','placeholder' => ''.e(__('auth.register.phone_number_placeholder')).'']); ?>
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

                <button type="submit" class="button submit"><?php echo e(__('auth.register.confirm_button')); ?></button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function registrationForm() {
            return {
                step: 1,
                hasFile: false,
                photoStyle: '',

                nextStep() {
                    if (this.validateStepOne()) {
                        this.step = 2;
                    } else {
                        console.log('Validation failed');
                    }
                },

                validateStepOne() {
                    let isValid = true;

                    const emailInput = this.$refs.email;
                    const passwordInput = this.$refs.password;
                    const confirmInput = this.$refs.passwordConfirmation;

                    if (!emailInput || !passwordInput || !confirmInput) {
                        console.error('One or more input refs not found');
                        return false;
                    }

                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    const emailValid = emailRegex.test(emailInput.value.trim());
                    this.toggleValidityClass(emailInput, emailValid);
                    if (!emailValid) isValid = false;

                    const passwordValid = passwordInput.value.trim().length >= 8;
                    this.toggleValidityClass(passwordInput, passwordValid);
                    if (!passwordValid) isValid = false;

                    const passwordsMatch = passwordInput.value.trim() === confirmInput.value.trim() && passwordValid;
                    this.toggleValidityClass(confirmInput, passwordsMatch);
                    this.toggleValidityClass(passwordInput, passwordsMatch && passwordValid);

                    if (!passwordsMatch) isValid = false;

                    return isValid;
                },

                toggleValidityClass(el, valid) {
                    if (valid) {
                        el.classList.remove('invalid');
                        el.classList.add('valid');
                    } else {
                        el.classList.remove('valid');
                        el.classList.add('invalid');
                    }
                },

                triggerFileInput() {
                    this.$el.querySelector('#profile-photo')?.click();
                },

                fileChanged(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();

                    reader.onload = ({ target }) => {
                        this.photoStyle = `background-image: url(${target.result}); background-size: cover; background-position: center;`;
                        this.hasFile = true;
                    };

                    reader.readAsDataURL(file);
                }
            };
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/auth/register.blade.php ENDPATH**/ ?>