<?php

namespace App\Http\Controllers\Checkout;

use App\Services\CacheService;
use App\Services\Delivery\Factory\DeliveryServiceFactory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    private CacheService $cacheService;
    private DeliveryServiceFactory $deliveryServiceFactory;

    public function __construct(DeliveryServiceFactory $deliveryServiceFactory, CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
        $this->deliveryServiceFactory = $deliveryServiceFactory;
    }

    /**
     * Retrieve a list of warehouses based on the selected delivery method and city.
     */
    public function getWarehouses(Request $request): JsonResponse
    {
        $cityRef = $request->user()?->address?->city_ref;
        $deliveryMethod = $request->query('delivery_method');

        $service = $this->deliveryServiceFactory->getService($deliveryMethod);

        if (!$service) {
            return response()->json(['error' => 'Unsupported delivery method'], 400);
        }

        $cacheKey = sprintf('warehouses_%s_%s', $deliveryMethod, $cityRef);
        $warehouses = $this->cacheService->remember(
            $cacheKey,
            fn() => $service->getWarehouses($cityRef),
            ttl: 360
        );

        return response()->json($warehouses);
    }
}
