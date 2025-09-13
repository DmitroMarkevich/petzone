<?php $__env->startSection('title', 'Редагування оголошення'); ?>

<?php $__env->startSection('profile-content'); ?>
    <div class="record-container">
        <h2 class="page-title">Редагувати оголошення</h2>
        <?php if (isset($component)) { $__componentOriginal5396e14faf16f8dd52d3b2ba72c120c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5396e14faf16f8dd52d3b2ba72c120c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.advert.form','data' => ['action' => route('advert.update', $advert),'advert' => $advert,'categories' => $categories]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('advert.form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('advert.update', $advert)),'advert' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($advert),'categories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($categories)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5396e14faf16f8dd52d3b2ba72c120c7)): ?>
<?php $attributes = $__attributesOriginal5396e14faf16f8dd52d3b2ba72c120c7; ?>
<?php unset($__attributesOriginal5396e14faf16f8dd52d3b2ba72c120c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5396e14faf16f8dd52d3b2ba72c120c7)): ?>
<?php $component = $__componentOriginal5396e14faf16f8dd52d3b2ba72c120c7; ?>
<?php unset($__componentOriginal5396e14faf16f8dd52d3b2ba72c120c7); ?>
<?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/advert/edit.blade.php ENDPATH**/ ?>