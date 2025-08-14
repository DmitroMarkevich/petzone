<?php $__env->startSection('title', 'Результати пошуку'); ?>

<?php $__env->startSection('app-content'); ?>
    <div class="page-container">
        <div style="margin-top: 40px">
            <div class="breadcrumb">
                <a href="<?php echo e(route('home')); ?>">
                    <img src="<?php echo e(asset('images/left-arrow.svg')); ?>" alt="Back">
                </a>
                <span class="category-path">Dogs / Food / Vitamins</span>
            </div>

            <div style="display: flex; gap: 48px">
                <div class="filter-results-container">
                    <div class="filters">
                        <div class="form-row">
                            <h3>Фільтрувати</h3>
                            <button class="filters-clear">Очистити все</button>
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
                                <label>Локація</label>
                                <input type="text" placeholder="Місто / Район">
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

                            <div class="filter-group">
                                <label>Додатково</label>
                                <div>
                                    <input type="checkbox" id="certified">
                                    <label for="certified">Сертифікований майстер</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="online-consult">
                                    <label for="online-consult">Онлайн консультація</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="home-service">
                                    <label for="home-service">Виїзд додому</label>
                                </div>
                            </div>

                            <div class="filter-group">
                                <label>Ветеринарні послуги</label>
                                <div>
                                    <input type="checkbox" id="vaccination">
                                    <label for="vaccination">Вакцинація</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="chip">
                                    <label for="chip">Чіпування</label>
                                </div>
                                <div>
                                    <input type="checkbox" id="sterilization">
                                    <label for="sterilization">Стерилізація / Кастрація</label>
                                </div>
                            </div>
                        </div>
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

                        <div class="adverts">
                            <div class="advert-grid">
                                <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('components.advert-card', ['advert' => $advert], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php if($adverts->hasPages()): ?>
                                <?php echo e($adverts->links()); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<style>
    .filter-results-container {
        display: flex;
        gap: 50px;
    }

    .filters-list {
        width: 300px;
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    select, input {
        width: 100%;
        padding: 8px;
        border: 1px solid black;
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

    .filters-clear {
        color: #797677;
    }

    .sort-options {
        font-family: 'Inter', sans-serif;
        border: 1px solid #E6E1E2;
    }
</style>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dmark\PhpstormProjects\petzone\resources\views/adverts/index.blade.php ENDPATH**/ ?>