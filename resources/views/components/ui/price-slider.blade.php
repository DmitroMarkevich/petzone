@props(['max' => 10000])

<div
    x-data="rangeSlider({
        min: 0,
        max: {{ (int) $max }},
        priceMin: {{ (int) request('price_min', 0) }},
        priceMax: {{ (int) request('price_max', $max) }} })"
    x-init="init()"
    class="filter-group"
>
    <label>Ціна</label>

    <div class="form-row">
        <input type="number" name="price_min" class="filter-input" x-model.number="priceMin" placeholder="від">
        <input type="number" name="price_max" class="filter-input" x-model.number="priceMax" placeholder="до">
    </div>

    <div class="slider-wrapper">
        <div class="slider-track"></div>
        <div class="slider-range" :style="{ left: percentMin + '%', width: (percentMax - percentMin) + '%' }"></div>
        <div class="slider-thumb left" @mousedown="startDrag('min', $event)" :style="{ left: percentMin + '%' }"></div>
        <div class="slider-thumb right" @mousedown="startDrag('max', $event)" :style="{ left: percentMax + '%' }"></div>
    </div>
</div>
