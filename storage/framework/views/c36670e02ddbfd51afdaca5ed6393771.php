<?php $__env->startSection('profile-content'); ?>
    <?php if($adverts->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div class="adverts-container">
            <h2 class="page-title">Мої оголошення</h2>

            <div class="filter-buttons">
                <button class="filter-button active">Всі (<?php echo e($adverts->count()); ?>)</button>
                <button class="filter-button" data-status="active">
                    Активні (<?php echo e($adverts->where('is_active', true)->count()); ?>)
                </button>
                <button class="filter-button" data-status="no-active">
                    Неактивні (<?php echo e($adverts->where('is_active', false)->count()); ?>)
                </button>
            </div>

            <div class="adverts-list">
                <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal4b7b31bf8150596c2e9ef372392491c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b7b31bf8150596c2e9ef372392491c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.advert-item','data' => ['advert' => $advert,'status' => $advert->is_active ? 'active' : 'no-active']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['advert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert->is_active ? 'active' : 'no-active')]); ?>
                         <?php $__env->slot('actions', null, []); ?> 
                            <a href="<?php echo e(route('adverts.edit', $advert->id)); ?>" class="edit-btn">Редагувати</a>

                            <form action="<?php echo e(route('adverts.destroy', $advert->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="delete-btn">Видалити</button>
                            </form>
                         <?php $__env->endSlot(); ?>
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/profile/statusFilter.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/adverts.blade.php ENDPATH**/ ?>