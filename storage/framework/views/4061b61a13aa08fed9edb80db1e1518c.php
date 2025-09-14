<?php $__env->startSection('title', 'Результати пошуку'); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="page-container" style="margin-top: 40px">
        <div class="breadcrumb">
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">
            </a>
            <span>Dogs / Food / Vitamins</span>
        </div>

        <div style="display: flex; gap: 50px">
            <div>
                <div class="form-row">
                    <h3>Фільтрувати</h3>
                    <button style="color: #797677">Очистити все</button>
                </div>

                <div class="filters-list">
                    <div class="filter-group">
                        <label for="category">Категорія</label>
                        <select id="category">
                            <option>Грумінг</option>
                            <option>Ветеринар</option>
                            <option>Дресирування</option>
                            <option>Готель для тварин</option>
                            <option>Вигул</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Ціна</label>
                        <div class="form-row">
                            <input type="number" min="0" placeholder="від" id="price-min">
                            <input type="number" min="0" placeholder="до" id="price-max">
                        </div>
                        <input type="range" min="0" max="10000" step="10" id="price-range">
                    </div>

                    <div class="filter-group">
                        <label>Локація
                            <input type="text" placeholder="Місто / Район">
                        </label>
                    </div>

                    <div class="filter-group">
                        <label for="animal-type">Вид тварини</label>
                        <select id="animal-type">
                            <option>Собаки</option>
                            <option>Коти</option>
                            <option>Гризуни</option>
                            <option>Птахи</option>
                            <option>Рептилії</option>
                        </select>
                    </div>
                </div>
            </div>

            <?php if($adverts->isEmpty()): ?>
                <div class="no-results" style="flex: 1; width: 100%">
                    <p><?php echo e(__('common.nothing_found')); ?></p>
                </div>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; gap: 30px; width: 100%">
                    <div class="form-row">
                        <p>Всього ~<?php echo e($adverts->total()); ?> результатів</p>

                        <?php if (isset($component)) { $__componentOriginal0034da402c85560bef13a411a8a95196 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0034da402c85560bef13a411a8a95196 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.sort-options','data' => ['options' => [
                                    'relevance' => 'За релевантністю',
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
                                    'relevance' => 'За релевантністю',
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

                    <div class="advert-grid">
                        <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                    <?php if($adverts->hasPages()): ?>
                        <?php echo e($adverts->links()); ?>

                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    .filters-list {
        width: 300px;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    select, input {
        width: 100%;
        padding: 8px;
        border: 1px solid #E6E1E2;
        border-radius: 5px;
        font-size: 14px;
    }

</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/advert/index.blade.php ENDPATH**/ ?>