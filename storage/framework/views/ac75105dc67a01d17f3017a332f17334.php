<?php $__env->startSection('title', 'Вподобання'); ?>

<?php $__env->startSection('profile-content'); ?>
    <?php if($wishlist->isEmpty()): ?>
        <div class="no-results">
            <p><?php echo e(__('common.nothing_found')); ?></p>
        </div>
    <?php else: ?>
        <div class="wishlist-wrapper">
            <div class="wishlist-header">
                <p>Всього ~<?php echo e($wishlist->total()); ?> результатів</p>

                <?php if (isset($component)) { $__componentOriginal0034da402c85560bef13a411a8a95196 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0034da402c85560bef13a411a8a95196 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sort-options','data' => ['options' => [
                        '' => 'За релевантністю',
                        'price-asc' => 'Від дешевих до дорогих',
                        'price-desc' => 'Від дорогих до дешевих',
                        'date-asc' => 'Новинки'
                    ],'selected' => request('sort')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.sort-options'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                        '' => 'За релевантністю',
                        'price-asc' => 'Від дешевих до дорогих',
                        'price-desc' => 'Від дорогих до дешевих',
                        'date-asc' => 'Новинки'
                    ]),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request('sort'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0034da402c85560bef13a411a8a95196)): ?>
<?php $attributes = $__attributesOriginal0034da402c85560bef13a411a8a95196; ?>
<?php unset($__attributesOriginal0034da402c85560bef13a411a8a95196); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0034da402c85560bef13a411a8a95196)): ?>
<?php $component = $__componentOriginal0034da402c85560bef13a411a8a95196; ?>
<?php unset($__componentOriginal0034da402c85560bef13a411a8a95196); ?>
<?php endif; ?>
            </div>

            <div class="wishlist-container">
                <?php $__currentLoopData = $wishlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginalf74e02aea032995600afb10c96aa9574 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf74e02aea032995600afb10c96aa9574 = $attributes; } ?>
<?php $component = App\View\Components\AdvertCard::resolve(['advert' => $advert] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdvertCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf74e02aea032995600afb10c96aa9574)): ?>
<?php $attributes = $__attributesOriginalf74e02aea032995600afb10c96aa9574; ?>
<?php unset($__attributesOriginalf74e02aea032995600afb10c96aa9574); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf74e02aea032995600afb10c96aa9574)): ?>
<?php $component = $__componentOriginalf74e02aea032995600afb10c96aa9574; ?>
<?php unset($__componentOriginalf74e02aea032995600afb10c96aa9574); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if($wishlist->hasPages()): ?>
                <?php echo e($wishlist->links()); ?>

            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/modules/ui/wishlist.js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/profile/wishlist.blade.php ENDPATH**/ ?>