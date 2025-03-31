<?php

namespace App;

use UnitEnum;

enum PaymentMethod: string implements Translatable
{
    case CREDIT_CARD = 'CREDIT_CARD';
    case CASH_ON_DELIVERY = 'CASH_ON_DELIVERY';

    public static function values(): array
    {
        return array_map(fn ($method) => $method->value, self::cases());
    }

    public static function getTranslation(UnitEnum $method): string
    {
        return __('payment.' . $method->name);
    }
}
