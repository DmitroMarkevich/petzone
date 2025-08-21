<?php

namespace App\Services\Delivery\Contracts;

interface DeliveryService
{
    public function getWarehouses(string $cityRef, int $page, string $warehouseRef): array;
}
