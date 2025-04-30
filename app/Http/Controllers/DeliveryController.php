<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\MeestService;
use App\Services\NovaPostService;

class DeliveryController extends Controller
{
    private MeestService $meestService;
    private NovaPostService $novaPostService;

    /**
     * @param NovaPostService $novaPostService
     * @param MeestService $meestService
     */
    public function __construct(MeestService $meestService, NovaPostService $novaPostService)
    {
        $this->meestService = $meestService;
        $this->novaPostService = $novaPostService;
    }

    /**
     * Retrieve a list of warehouses based on the selected delivery method and city.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getWarehouses(Request $request): JsonResponse
    {
        $defCityRef = auth()->user()?->address?->ref_delivery_city;
        $cityRef = $request->query('cityRef', $defCityRef);

        $deliveryMethod = $request->query('delivery_method');

        $warehouses = [];

        if ($deliveryMethod == 'nova_post') {
            $warehouses1 = $this->novaPostService->getWarehouses($cityRef);
            $warehouses = $this->novaPostService->filterWarehousesByTypes($warehouses1, '9a68df70-0267-42a8-bb5c-37f427e36ee4');
        } elseif ($deliveryMethod == 'meest') {
            $warehouses = $this->meestService->getWarehouses($cityRef);
        }

        return response()->json($warehouses);
    }
}
