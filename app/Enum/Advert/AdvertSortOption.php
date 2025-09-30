<?php

namespace App\Enum\Advert;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

enum AdvertSortOption: string
{
    case Relevance = 'relevance';
    case PriceAsc = 'price-asc';
    case PriceDesc = 'price-desc';
    case DateAsc = 'date-asc';

    public function apply(Builder|Relation $query): Relation|Builder
    {
        return match ($this) {
            self::Relevance => $query,
            self::PriceAsc => $query->orderBy('price'),
            self::PriceDesc => $query->orderBy('price', 'desc'),
            self::DateAsc => $query->orderBy('created_at', 'desc'),
        };
    }

    public static function tryFromRequest(?string $value): ?self
    {
        return self::tryFrom($value);
    }
}
