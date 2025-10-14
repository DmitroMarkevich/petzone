<?php

namespace App\Services\Advert\Builders;

use App\DTO\AdvertFilter;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use Laravel\Scout\Builder;

class SearchBuilder
{
    public function build(AdvertFilter $filter): Builder
    {
        $builder = Advert::search($filter->query);

        if ($filter->category) {
            $this->applyCategoryFilter($builder, $filter->category);
        }

        if ($filter->filter === 'discounted') {
            $builder->where('has_discount', true);
        }

        $this->applyPriceFilter($builder, $filter->price_min, $filter->price_max);
        $this->applySort($builder, $filter->sort);

        return $builder;
    }

    private function applySort($builder, ?string $sort): void
    {
        $sortMap = [
            'price-asc' => ['price', 'asc'],
            'price-desc' => ['price', 'desc'],
            'date-asc' => ['created_at', 'asc'],
        ];

        if (isset($sortMap[$sort])) {
            [$column, $direction] = $sortMap[$sort];
            $builder->orderBy($column, $direction);
        }
    }

    private function applyCategoryFilter($builder, string $categorySlug): void
    {
        $category = Category::where('slug', $categorySlug)->first();

        if (!$category) {
            return;
        }

        if ($category->children()->exists()) {
            $ids = $category->children()->pluck('id')->toArray();
            $ids[] = $category->id;
            $builder->whereIn('category_id', $ids);
        } else {
            $builder->where('category_id', $category->id);
        }
    }

    private function applyPriceFilter(Builder $builder, ?float $min, ?float $max): void
    {
        // Scout does not support normal range filters
        if ($min) {
            $builder->where('price >', $min);
        }

        if ($max) {
            $builder->where('price <', $max);
        }
    }
}
