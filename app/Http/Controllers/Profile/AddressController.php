<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\Profile\AddressService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    private AddressService $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    /**
     * Search for cities by name.
     */
    public function searchCities(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search', '');

        $cities = $this->addressService->searchCities($searchTerm);

        return response()->json($cities);
    }

    /**
     * Search for streets in a specific city.
     */
    public function searchStreets(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search', '');
        $cityRef = $request->query('cityRef', '');

        $streets = $this->addressService->searchStreets($cityRef, $searchTerm);

        return response()->json($streets);
    }
}
