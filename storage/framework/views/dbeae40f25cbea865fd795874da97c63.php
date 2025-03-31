<?php $__env->startSection('app-content'); ?>
    <div class="page-container">
        <h1>Створити оголошення</h1>

        <form action="<?php echo e(route('adverts.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'text','name' => 'title','label' => 'Заголовок','value' => ''.e(old('title')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','name' => 'title','label' => 'Заголовок','value' => ''.e(old('title')).'']); ?>
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

                <label for="description">Product Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo e(old('description')); ?></textarea>

                <label for="category">Категорія</label>
                <select id="category" name="category_id" required>
                    <option value="">Select a Category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="photo-grid">
                <?php for($i = 1; $i <= 8; $i++): ?>
                    <div class="photo-upload">
                        <input type="file" name="images[]" id="photo-<?php echo e($i); ?>" accept="image/*" class="photo-input">
                        <label for="photo-<?php echo e($i); ?>" class="photo-label">
                            <span class="placeholder-text">+</span>
                        </label>
                    </div>
                <?php endfor; ?>
            </div>

            <div class="form-group">
                <label for="condition">Стан товару</label>
                <select id="condition" name="condition" required>
                    <option value="new" <?php echo e(old('condition') == 'new' ? 'selected' : ''); ?>>Новий</option>
                    <option value="used" <?php echo e(old('condition') == 'used' ? 'selected' : ''); ?>>Б/У</option>
                </select>
            </div>

            <div class="form-group">
                <label for="item_type">Тип оголошення</label>
                <select id="item_type" name="item_type" required>
                    <option value="product" <?php echo e(old('item_type') == 'product' ? 'selected' : ''); ?>>Товар</option>
                    <option value="service" <?php echo e(old('item_type') == 'service' ? 'selected' : ''); ?>>Послуга</option>
                </select>
            </div>


            <div class="form-group">
                <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['type' => 'number','name' => 'price','label' => 'Ціна','value' => ''.e(old('price')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'number','name' => 'price','label' => 'Ціна','value' => ''.e(old('price')).'']); ?>
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

            <button type="submit" class="btn-change">Зберегти</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<style>
    textarea {
        position: relative;
        background-repeat: no-repeat;
        background-position: 15px center;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin: 20px 0;
    }

    .photo-upload {
        position: relative;
        width: 100%;
        padding-top: 100%;
        border: 2px dashed #ccc;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
    }

    .photo-upload input[type="file"] {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .photo-upload .photo-label {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        color: #aaa;
        transition: background-color 0.3s, color 0.3s;
    }

    .photo-upload:hover .photo-label {
        background-color: rgba(0, 0, 0, 0.1);
        color: #000;
    }

    .photo-upload img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
    }
</style>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/advert/photo-upload.js']); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/create.blade.php ENDPATH**/ ?>