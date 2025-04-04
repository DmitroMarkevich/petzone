<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\NovaPostService;

class AddressController extends Controller
{
    private NovaPostService $novaPostService;

    /**
     * @param NovaPostService $novaPostService
     */
    public function __construct(NovaPostService $novaPostService)
    {
        $this->novaPostService = $novaPostService;
    }

    /**
     * Search for cities by name using Nova Post API.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchCities(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search', '');

        $cities = $this->novaPostService->searchCities($searchTerm);

        return response()->json($cities);
    }

    /**
     * Search for streets in a specific city using Nova Post API.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchStreets(Request $request): JsonResponse
    {
        $cityRef = $request->query('cityRef', '');
        $searchTerm = $request->query('search', '');

        $streets = $this->novaPostService->searchStreets($cityRef, $searchTerm);

        return response()->json($streets);
    }
}
