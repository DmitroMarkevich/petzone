<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['action','advert' => null,'categories' => []]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['action','advert' => null,'categories' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div x-data="advertForm(<?php echo json_encode($advert, 15, 512) ?>)">
    <form action="<?php echo e($action); ?>" method="POST" enctype="multipart/form-data" class="advert-form">
        <?php echo csrf_field(); ?>
        <?php if($advert): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <input type="hidden" name="action" id="form-action" value="save">

        <div class="form-main">
            <div class="form-group">
                <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'text','name' => 'title','label' => 'Заголовок','value' => ''.e(old('title', $advert->title ?? '')).'','placeholder' => 'Введіть заголовок товару','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'title','label' => 'Заголовок','value' => ''.e(old('title', $advert->title ?? '')).'','placeholder' => 'Введіть заголовок товару','required' => true]); ?>
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

                <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'category_id','name' => 'category_id','label' => 'Категорія','options' => $categories,'selected' => old('category_id', $advert->category_id ?? null),'class' => 'form-control','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'category_id','name' => 'category_id','label' => 'Категорія','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('category_id', $advert->category_id ?? null)),'class' => 'form-control','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>

                <div class="photo-grid">
                    <?php for($i = 1; $i <= 8; $i++): ?>
                        <?php
                            $image = $advert->images[$i - 1] ?? null;
                        ?>

                        <div class="photo-upload" x-bind:data-filled="uploads[<?php echo e($i); ?>].filled" data-index="<?php echo e($i); ?>">
                            <input type="file"
                                   name="images[]"
                                   id="photo-<?php echo e($i); ?>"
                                   accept="image/*"
                                   class="photo-input"
                                   @change="handleFileUpload($event, <?php echo e($i); ?>)">

                            <label for="photo-<?php echo e($i); ?>" class="photo-label">
                                <img x-show="uploads[<?php echo e($i); ?>].src" x-bind:src="uploads[<?php echo e($i); ?>].src" alt="Фото">
                                <span x-show="!uploads[<?php echo e($i); ?>].src" class="placeholder-text">+</span>
                            </label>

                            <div x-show="<?php echo e($i); ?> === 1 && uploads[<?php echo e($i); ?>].filled" class="photo-main-label" x-cloak>
                                Головне
                            </div>

                            <?php if($image): ?>
                                <img src="<?php echo e(image_url($image->image_path)); ?>" class="existing-photo" alt="Фото <?php echo e($i); ?>">
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>

                <div>
                    <label for="description">Опис товару</label>
                    <textarea id="description" name="description" rows="11"
                              placeholder="Введіть опис товару"
                              required><?php echo e(old('description', $advert->description ?? '')); ?></textarea>
                </div>

                <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'advert_condition','name' => 'advert_condition','label' => 'Стан товару','options' => ['new' => 'Новий', 'used' => 'Б/У'],'selected' => old('advert_condition', $advert->advert_condition ?? 'new'),'class' => 'form-control','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'advert_condition','name' => 'advert_condition','label' => 'Стан товару','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['new' => 'Новий', 'used' => 'Б/У']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('advert_condition', $advert->advert_condition ?? 'new')),'class' => 'form-control','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'advert_type','name' => 'advert_type','label' => 'Тип оголошення','options' => ['product' => 'Товар', 'service' => 'Послуга'],'selected' => old('advert_type', $advert->advert_type ?? 'product'),'class' => 'form-control','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'advert_type','name' => 'advert_type','label' => 'Тип оголошення','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['product' => 'Товар', 'service' => 'Послуга']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('advert_type', $advert->advert_type ?? 'product')),'class' => 'form-control','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>

                <div class="short-input-wrapper">
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['type' => 'number','name' => 'price','label' => 'Ціна','value' => ''.e(old('price', $advert->price ?? '')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'price','label' => 'Ціна','value' => ''.e(old('price', $advert->price ?? '')).'','required' => true]); ?>
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
        </div>

        <div class="form-actions">
            <button type="submit" name="action" value="preview" class="btn-preview">Попередній перегляд</button>
            <button type="submit" name="action" value="save" class="btn-change">Зберегти</button>
        </div>
    </form>
</div>

<script>
function advertForm(advert = null) {
    return {
        uploads: Array.from({length: 9}, (_, i) => ({
            filled: !!(advert?.images[i-1] ?? false),
            src: advert?.images[i-1]?.image_path ? "<?php echo e(url('storage')); ?>/" + advert.images[i-1].image_path : ''
        })),

        handleFileUpload(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            const targetIndex = this.findTargetSlot(index);
            this.setFileToSlot(file, targetIndex);

            if (targetIndex !== index) {
                event.target.value = '';
            }
        },

        findTargetSlot(currentIndex) {
            if (!this.uploads[currentIndex].filled) return currentIndex;

            for (let i = 1; i <= 8; i++) {
                if (!this.uploads[i].filled) return i;
            }
            return currentIndex;
        },

        setFileToSlot(file, index) {
            this.uploads[index].filled = true;
            this.uploads[index].src = URL.createObjectURL(file);

            const input = document.getElementById(`photo-${index}`);
            if (input) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }
        }
    }
}
</script>
<?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/components/advert/form.blade.php ENDPATH**/ ?>