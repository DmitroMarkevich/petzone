<?php $__env->startSection('title', 'Мої оголошення'); ?>

<?php $__env->startSection('profile-content'); ?>
    <?php if($adverts->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div class="adverts-container">
            <h2 class="page-title">Мої оголошення</h2>

            <?php if (isset($component)) { $__componentOriginal4441bf567c34cce16583deb6643469f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4441bf567c34cce16583deb6643469f6 = $attributes; } ?>
<?php $component = App\View\Components\FilterButtons::resolve(['items' => $adverts->getCollection(),'filters' => [
                ['key' => 'is_active', 'value' => true, 'label' => 'Активні'],
                ['key' => 'is_active', 'value' => false, 'label' => 'Неактивні']
            ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalb462f209552f33171c7094020d950465 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb462f209552f33171c7094020d950465 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.advert.item','data' => ['advert' => $advert,'status' => $advert->is_active]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['advert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert),'status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert->is_active)]); ?>
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
<?php if (isset($__attributesOriginalb462f209552f33171c7094020d950465)): ?>
<?php $attributes = $__attributesOriginalb462f209552f33171c7094020d950465; ?>
<?php unset($__attributesOriginalb462f209552f33171c7094020d950465); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb462f209552f33171c7094020d950465)): ?>
<?php $component = $__componentOriginalb462f209552f33171c7094020d950465; ?>
<?php unset($__componentOriginalb462f209552f33171c7094020d950465); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($adverts->hasPages()): ?>
                <?php echo e($adverts->links()); ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/adverts.blade.php ENDPATH**/ ?>