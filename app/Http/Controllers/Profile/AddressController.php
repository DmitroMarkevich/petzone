<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\Profile\AddressService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    private AddressService $novaPostService;

    /**
     * @param AddressService $novaPostService
     */
    public function __construct(AddressService $novaPostService)
    {
        $this->novaPostService = $novaPostService;
    }

    /**
     * Search for cities by name using Nova Post API.
     */
    public function searchCities(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search', '');

        $cities = $this->novaPostService->searchCities($searchTerm);

        return response()->json($cities);
    }

    /**
     * Search for streets in a specific city using Nova Post API.
     */
    public function searchStreets(Request $request): JsonResponse
    {
        $cityRef = $request->query('cityRef', '');
        $searchTerm = $request->query('search', '');

        $streets = $this->novaPostService->searchStreets($cityRef, $searchTerm);

        return response()->json($streets);
    }
}
