<?php

namespace App\Enum;

use App\Enum\Contracts\Translatable;
use UnitEnum;

enum DeliveryMethod: string implements Translatable
{
    case NOVA_POST_SELF_PICKUP = 'NOVA_POST_SELF_PICKUP';
    case MEEST_SELF_PICKUP = 'MEEST_SELF_PICKUP';
    case NOVA_POST_COURIER = 'NOVA_POST_COURIER';
    case MEEST_COURIER = 'MEEST_COURIER';
    case SELF_PICKUP = 'SELF_PICKUP';

    public static function values(): array
    {
        return array_map(fn ($method) => $method->value, self::cases());
    }

    public static function getTranslation(UnitEnum $method): string
    {
        return __('delivery.' . $method->name);
    }
}
