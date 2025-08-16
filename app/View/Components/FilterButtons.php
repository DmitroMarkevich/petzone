<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class FilterButtons extends Component
{
    public Collection $items;

    public array $filters;

    public array $counts = [];

    /**
     * Create a new component instance.
     */
    public function __construct($items, array $filters)
    {
        $this->items = $items;
        $this->filters = $filters;

        // Calculate counts for each filter
        foreach ($filters as $filter) {
            $key = $filter['key'];
            $value = $filter['value'];
            $this->counts["$key.$value"] = $items->where($key, $value)->count();
        }

        $this->counts['all'] = $items->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.filter-buttons');
    }
}
