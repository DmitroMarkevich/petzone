<?php $__env->startSection('title', 'Результати пошуку'); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="page-container">
        <div style="margin-top: 40px">
            <div class="breadcrumb">
                <a href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">
                </a>
                <span>Dogs / Food / Vitamins</span>
            </div>

            <div style="display: flex; gap: 48px">
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
                        7/div>
                    </div>
                </div>

                <?php if($adverts->isEmpty()): ?>
                    <div class="no-results">
                        <p><?php echo e(__('common.nothing_found')); ?></p>
                    </div>
                <?php else: ?>
                    <div style="display: flex; flex-direction: column; width: 100%">
                        <div class="form-row" style="margin-bottom: 30px;">
                            <p>Всього ~<?php echo e(count($adverts)); ?> результатів</p>

                            <div class="sort-container">
                                <label for="sort-options"></label>
                                <select id="sort-options" class="sort-options">
                                    <option value="price-asc">Від дешевих до дорогих</option>
                                    <option value="price-desc">Від дорогих до дешевих</option>
                                    <option value="date-asc">Новинки</option>
                                    <option value="date-asc" selected>За рейтингом</option>
                                </select>
                            </div>
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

    input[type="checkbox"] {
        width: auto;
        margin-right: 5px;
    }

    .filter-group div {
        display: flex;
        align-items: center;
    }

    .sort-options {
        border: 1px solid #E6E1E2;
    }
</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/index.blade.php ENDPATH**/ ?>