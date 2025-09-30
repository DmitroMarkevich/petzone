<?php

namespace App\Enum\Advert;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

enum AdvertFilterOption: string
{
    case Discounted = 'discounted';
    case Fresh = 'fresh';

    public function apply(Builder|Relation $query): Relation|Builder
    {
        return match ($this) {
            self::Discounted => $query
                ->whereColumn('previous_price', '>', 'price')
                ->where('price_changed_at', '>=', now()->subWeeks(3)),
            self::Fresh => $query->latest(),
        };
    }

    public static function tryFromRequest(?string $value): ?self
    {
        return self::tryFrom($value);
    }
}
