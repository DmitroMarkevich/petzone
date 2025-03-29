<?php $__env->startSection('app-content'); ?>
    <div>
        <h2>Create Product</h2>

        <form action="<?php echo e(route('adverts.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div>
                <label for="title">Product Title</label>
                <input type="text" id="title" name="title" value="<?php echo e(old('title')); ?>" required>
            </div>

            <div>
                <label for="description">Product Description</label>
                <textarea id="description" name="description" rows="4" required><?php echo e(old('description')); ?></textarea>
            </div>

            <div>
                <label for="price">Product Price</label>
                <input type="number" id="price" name="price" value="<?php echo e(old('price')); ?>" required>
            </div>

            <div>
                <label for="category">Category</label>
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

            <button type="submit">Create Product</button>
        </form>
    </div>

    <style>
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
<?php $__env->stopSection(); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/js/advert/photo-upload.js']); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/create.blade.php ENDPATH**/ ?>