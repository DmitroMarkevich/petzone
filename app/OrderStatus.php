<?php

namespace App;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
    case DELIVERED = 'delivered';
}
