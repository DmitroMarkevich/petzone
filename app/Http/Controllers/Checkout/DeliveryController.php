<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Services\Delivery\Factory\DeliveryServiceFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    protected DeliveryServiceFactory $deliveryServiceFactory;

    public function __construct(DeliveryServiceFactory $deliveryServiceFactory)
    {
        $this->deliveryServiceFactory = $deliveryServiceFactory;
    }

    /**
     * Retrieve a list of warehouses based on the selected delivery method and city.
     */
    public function getWarehouses(Request $request): JsonResponse
    {
        $city = $request->user()?->address?->city_ref;
        $deliveryMethod = $request->query('delivery_method');

        $service = $this->deliveryServiceFactory->getService($deliveryMethod);

        if (!$service) {
            return response()->json(['error' => 'Unsupported delivery method'], 400);
        }

        $warehouses = $service->getWarehouses($city);

        return response()->json($warehouses);
    }
}
