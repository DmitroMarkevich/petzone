<div class="filter-buttons">
    <button class="filter-button active" data-status="all">
        Всі ({{ $counts['all'] ?? 0 }})
    </button>

    @foreach ($filters as $filter)
        <button class="filter-button" data-status="{{ strtolower($filter['value']) }}">
            {{ $filter['label'] ?? $filter['value'] }} ({{ $counts["{$filter['key']}.{$filter['value']}"] ?? 0 }})
        </button>
    @endforeach
</div>
