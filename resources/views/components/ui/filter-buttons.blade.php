@props([
    'items',
    'filters' => [],
    'queryKey' => 'filter',
])

@php
    $currentValue = request($queryKey);
@endphp

<div class="filter-buttons">
    @foreach ($filters as $filter)
        @php
            $value = $filter['value'];
            $label = $filter['label'];
            $key = $queryKey;

            $count = $items->filter(fn ($item) => data_get($item, $filter['key']) == $value)->count();

            $isActive = (string) $currentValue === (string) $value;

            $totalCount = $items->count();
            $isAllActive = is_null($currentValue);
        @endphp

        <a href="{{ request()->fullUrlWithQuery([$queryKey => null]) }}"
           class="filter-button {{ $isAllActive ? 'active' : '' }}">
            Всі ({{ $totalCount }})
        </a>
    @endforeach
</div>
