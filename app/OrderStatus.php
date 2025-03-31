<?php

namespace App;

enum OrderStatus: string
{
    case PENDING = 'PENDING';
    case PROCESSING = 'PROCESSING';
    case SHIPPED = 'SHIPPED';
    case COMPLETED = 'COMPLETED';
    case CANCELED = 'CANCELED';
    case DELIVERED = 'DELIVERED';

    /**
     * Get all values of the delivery methods.
     *
     * @return array List of delivery method values.
     */
    public static function values(): array
    {
        return array_map(fn ($method) => $method->value, self::cases());
    }
}
