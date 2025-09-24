<?php

namespace App\Services\Delivery\Factory;

use App\Services\Delivery\Contracts\DeliveryService;
use App\Services\Delivery\MeestService;
use App\Services\Delivery\NovaPostService;

class DeliveryServiceFactory
{
    protected MeestService $meestService;
    protected NovaPostService $novaPostService;

    public function __construct(MeestService $meestService, NovaPostService $novaPostService)
    {
        $this->meestService = $meestService;
        $this->novaPostService = $novaPostService;
    }

    public function getService(string $deliveryMethod): ?DeliveryService
    {
        return match ($deliveryMethod) {
            'nova_post' => $this->novaPostService,
            'meest' => $this->meestService,
            default => null,
        };
    }
}
