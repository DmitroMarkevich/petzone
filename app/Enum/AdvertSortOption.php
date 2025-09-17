<?php

namespace App\Enum;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

enum AdvertSortOption: string
{
    case Relevance = 'relevance';
    case PriceAsc = 'price-asc';
    case PriceDesc = 'price-desc';
    case DateAsc = 'date-asc';

    // Builder|Relation because this method works with Builder or with Relation. Both can use orderBy.
    public function apply(Builder|Relation $query): Relation|Builder
    {
        return match ($this) {
            self::Relevance => $query,
            self::PriceAsc => $query->orderBy('price'),
            self::PriceDesc => $query->orderBy('price', 'desc'),
            self::DateAsc => $query->orderBy('created_at', 'desc'),
        };
    }

    public static function tryFromRequest(?string $sort): ?self
    {
        return self::tryFrom($sort);
    }
}
