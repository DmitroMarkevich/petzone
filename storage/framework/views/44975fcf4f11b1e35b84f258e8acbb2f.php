<?php $__env->startSection('title', 'Мій профіль'); ?>

<?php $__env->startSection('profile-content'); ?>
    <div class="profile-container" x-data="profileData()">
        <div class="profile-header">
            <?php if(!empty(auth()->user()->image_path)): ?>
                <img x-ref="avatar" src="<?php echo e(image_url($user->image_path)); ?>" alt="Avatar" class="profile-avatar">
            <?php else: ?>
                <img x-ref="avatar" src="<?php echo e(asset('images/default-avatar.png')); ?>" alt="Avatar" class="profile-avatar">
            <?php endif; ?>

            <div class="profile-info">
                <h2 class="profile-greeting">Вітаємо, <?php echo e($user->first_name); ?>!</h2>

                <div class="profile-actions photo">
                    <form x-ref="photoForm" action="<?php echo e(route('profile.uploadAvatar')); ?>" method="POST"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="file" x-ref="fileInput" name="profile-photo" class="hidden"
                               accept=".jpeg,.png,.jpg,.svg" @change="handleFileChange">

                        <div class="profile-actions">
                            <button type="button" class="btn-change" x-show="!editingAvatar"
                                    @click="$refs.fileInput.click()">
                                Змінити фото
                            </button>
                            <button type="submit" class="btn-change" x-show="editingAvatar" x-cloak>Зберегти</button>
                            <button type="button" class="btn-cancel" x-show="editingAvatar" @click="cancelPhoto"
                                    x-cloak>
                                Скасувати
                            </button>
                        </div>
                    </form>

                    <form action="<?php echo e(route('profile.deleteAvatar')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-delete" x-show="!editingAvatar">
                            <img src="<?php echo e(asset('images/profile/bin.svg')); ?>" alt="Bin Icon">Видалити фото
                        </button>
                    </form>
                </div>

                <?php $__errorArgs = ['profile-photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error-message">*<?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="profile-section my-data">
            <h4 class="section-title">
                <img src="<?php echo e(asset('images/profile/profile.svg')); ?>" alt="Profile">Мої дані
            </h4>

            <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="form-row">
                    <div class="form-group">
                        <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'first_name','label' => 'Ім\'я','value' => ''.e($user->first_name).'','maxlength' => '50','xBind:readonly' => '!editingProfile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'first_name','label' => 'Ім\'я','value' => ''.e($user->first_name).'','maxlength' => '50','x-bind:readonly' => '!editingProfile']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'last_name','label' => 'Прізвище','value' => ''.e($user->last_name).'','maxlength' => '50','xBind:readonly' => '!editingProfile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'last_name','label' => 'Прізвище','value' => ''.e($user->last_name).'','maxlength' => '50','x-bind:readonly' => '!editingProfile']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'email','name' => 'email','label' => 'Електронна адреса','value' => ''.e($user->email).'','readonly' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'email','name' => 'email','label' => 'Електронна адреса','value' => ''.e($user->email).'','readonly' => true]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'tel','name' => 'phone_number','label' => 'Номер телефону','placeholder' => '+38 (0__) ___ __ __','value' => ''.e($user->phone_number).'','xBind:readonly' => '!editingProfile']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'tel','name' => 'phone_number','label' => 'Номер телефону','placeholder' => '+38 (0__) ___ __ __','value' => ''.e($user->phone_number).'','x-bind:readonly' => '!editingProfile']); ?>
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

                <a href="#" class="link-icon" x-show="!editingProfile" @click.prevent="editingProfile = true">
                    <img src="<?php echo e(asset('images/profile/pencil.svg')); ?>" alt="Редагувати">Редагувати
                </a>

                <div class="profile-actions">
                    <button type="submit" class="btn-change" x-show="editingProfile" x-cloak>Зберегти</button>
                    <button type="button" class="btn-cancel" x-show="editingProfile" @click="editingProfile = false"
                            x-cloak>
                        Скасувати
                    </button>
                </div>
            </form>
        </div>

        <div class="profile-section delivery-address">
            <h4 class="section-title">
                <img src="<?php echo e(asset('images/profile/address.svg')); ?>" alt="Address">Адреса доставки
            </h4>

            <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="form-row">
                    <div class="form-group">
                        <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'city','label' => 'Місто','value' => ''.e($user->address->city ?? '').'','xBind:readonly' => '!editingAddress']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'city','label' => 'Місто','value' => ''.e($user->address->city ?? '').'','x-bind:readonly' => '!editingAddress']); ?>
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

                        <ul class="address-suggestions hidden"></ul>
                        <input type="hidden" name="ref_delivery_city">
                    </div>
                    <div class="form-group">
                        <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'street','label' => 'Вулиця','value' => ''.e($user->address->street ?? '').'','xBind:readonly' => '!editingAddress']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'street','label' => 'Вулиця','value' => ''.e($user->address->street ?? '').'','x-bind:readonly' => '!editingAddress']); ?>
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

                        <ul class="address-suggestions hidden"></ul>
                        <input type="hidden" name="ref_delivery_street">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group apartment">
                        <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'apartment','label' => 'Квартира','value' => ''.e($user->address->apartment ?? '').'','xBind:readonly' => '!editingAddress']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'apartment','label' => 'Квартира','value' => ''.e($user->address->apartment ?? '').'','x-bind:readonly' => '!editingAddress']); ?>
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

                <a href="#" class="link-icon" x-show="!editingAddress" @click.prevent="editingAddress = true">
                    <img src="<?php echo e(asset('images/profile/pencil.svg')); ?>" alt="Редагувати">Редагувати
                </a>

                <div class="profile-actions">
                    <button type="submit" class="btn-change" x-show="editingAddress" x-cloak>Зберегти</button>
                    <button type="button" class="btn-cancel" x-show="editingAddress" @click="editingAddress = false" x-cloak>
                        Скасувати
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php if(session('success')): ?>
        <?php if (isset($component)) { $__componentOriginalf0c95b89bbca1866d74c11d156e76d97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0c95b89bbca1866d74c11d156e76d97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.flash-message','data' => ['message' => session('success')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.flash-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('success'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0c95b89bbca1866d74c11d156e76d97)): ?>
<?php $attributes = $__attributesOriginalf0c95b89bbca1866d74c11d156e76d97; ?>
<?php unset($__attributesOriginalf0c95b89bbca1866d74c11d156e76d97); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0c95b89bbca1866d74c11d156e76d97)): ?>
<?php $component = $__componentOriginalf0c95b89bbca1866d74c11d156e76d97; ?>
<?php unset($__componentOriginalf0c95b89bbca1866d74c11d156e76d97); ?>
<?php endif; ?>
    <?php elseif(session('error')): ?>
        <?php if (isset($component)) { $__componentOriginalf0c95b89bbca1866d74c11d156e76d97 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf0c95b89bbca1866d74c11d156e76d97 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.flash-message','data' => ['message' => session('error'),'type' => 'error']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.flash-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['message' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('error')),'type' => 'error']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf0c95b89bbca1866d74c11d156e76d97)): ?>
<?php $attributes = $__attributesOriginalf0c95b89bbca1866d74c11d156e76d97; ?>
<?php unset($__attributesOriginalf0c95b89bbca1866d74c11d156e76d97); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf0c95b89bbca1866d74c11d156e76d97)): ?>
<?php $component = $__componentOriginalf0c95b89bbca1866d74c11d156e76d97; ?>
<?php unset($__componentOriginalf0c95b89bbca1866d74c11d156e76d97); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<script>
    function profileData() {
        return {
            editingAvatar: false,
            editingProfile: false,
            editingAddress: false,

            originalSrc: '',

            handleFileChange(e) {
                const file = e.target.files[0];
                if (!file) return;

                this.originalSrc = this.$refs.avatar.src;
                this.$refs.avatar.src = URL.createObjectURL(file);
                this.editingAvatar = true;
            },

            cancelPhoto() {
                this.$refs.avatar.src = this.originalSrc;
                this.$refs.fileInput.value = '';
                this.editingAvatar = false;
            },

            toggleAvatarButtons() {
                return {
                    showChange: !this.editingAvatar,
                    showSave: this.editingAvatar,
                    showCancel: this.editingAvatar,
                }
            }
        }
    }
</script>

<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/index.blade.php ENDPATH**/ ?>