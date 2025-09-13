@props(['type' => 'success', 'message' => ''])

@php
    $styles = [
        'success' => [
            'title' => 'Дякуємо!',
            'iconFill' => 'green',
            'iconPath' => 'M9 16.17L4.83 12l-1.42 1.41L9 19l12-12-1.41-1.42z',
        ],
        'error' => [
            'title' => 'Помилка!',
            'iconFill' => 'red',
            'iconPath' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z',
        ],
    ];
    $current = $styles[$type];
@endphp

<div
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 2000)"
    x-show="show"
    x-transition:leave="transition ease-in duration-400"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="flash-message flash-message--{{ $type }}"
>
    <svg class="icon" viewBox="0 0 24 24">
        <path fill="{{ $current['iconFill'] }}" d="{{ $current['iconPath'] }}"/>
    </svg>

    <h3 class="title">{{ $current['title'] }}</h3>
    <p>{{ $message }}</p>
</div>
