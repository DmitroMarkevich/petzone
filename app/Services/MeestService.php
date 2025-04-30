<?php

namespace App\Services;

use App\Services\Contracts\DeliveryService;

class MeestService implements DeliveryService
{
    public function getWarehouses(string $cityRef, int $page = 1, string $warehouseRef = null): array
    {
        return [];
    }
}
