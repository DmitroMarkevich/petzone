<?php

namespace App;

use UnitEnum;

enum OrderStatus: string implements Translatable
{
    case PROCESSING = 'PROCESSING';
    case PENDING = 'PENDING';
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
