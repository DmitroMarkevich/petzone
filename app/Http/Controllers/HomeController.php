<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Services\AdvertService;

class HomeController
{
    private AdvertService $advertService;

    /**
     * @param AdvertService $advertService
     */
    public function __construct(AdvertService $advertService)
    {
        $this->advertService = $advertService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View|Application
    {
        $freshAdverts = $this->advertService->getFreshAdverts(200, 5);
        $popularAdverts = $this->advertService->getFreshAdverts(200, 10);
        $discountedAdverts = $this->advertService->getFreshAdverts(200, 5);

        return view('home', compact('freshAdverts', 'popularAdverts', 'discountedAdverts'));
    }
}
