<?php

namespace App\Services\Advert\Builders;

use App\DTO\AdvertFilter;
use App\Models\Advert\Advert;
use Laravel\Scout\Builder;

class SearchBuilder
{
    public function build(AdvertFilter $filter): Builder
    {
        $builder = Advert::search($filter->query ?? '');

        if ($filter->category) {
            $builder->where('category_id', $filter->category);
        }

        if ($filter->filter === 'discounted') {
            $builder->where('has_discount', true);
        }

        $this->applySort($builder, $filter->sort);

        return $builder;
    }

    private function applySort($builder, ?string $sort): void
    {
        $sortMap = [
            'price-asc'  => ['price', 'asc'],
            'price-desc' => ['price', 'desc'],
            'date-asc'   => ['created_at', 'desc'],
        ];

        if (isset($sortMap[$sort])) {
            [$column, $direction] = $sortMap[$sort];
            $builder->orderBy($column, $direction);
        }
    }
}
