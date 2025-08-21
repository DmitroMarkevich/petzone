<?php

namespace App\Services\Delivery;

use App\Services\Delivery\Contracts\DeliveryService;

class MeestService implements DeliveryService
{
    public function getWarehouses(string $cityRef, int $page = 1, string $warehouseRef = null): array
    {
        return [];
    }
}
