<?php

namespace App\Services\Contracts;

interface DeliveryService
{
    public function getWarehouses(string $cityRef, int $page, string $warehouseRef): array;
}
