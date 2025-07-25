<?php

namespace App\Enum;

use UnitEnum;
use App\Enum\Contracts\Translatable;

enum OrderStatus: string implements Translatable
{
    case PENDING = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case SHIPPED = 'SHIPPED';
    case ARRIVED = 'ARRIVED';
    case RECEIVED = 'RECEIVED';
    case CANCELED = 'CANCELED';

    public static function values(): array
    {
        return array_map(fn ($method) => $method->value, self::cases());
    }

    public static function getTranslation(UnitEnum $method): string
    {
        return __('order.' . $method->name);
    }
}
