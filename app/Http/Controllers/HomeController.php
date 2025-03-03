<?php

namespace App\Http\Controllers;

use App\Services\AdvertService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

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
        $freshAdverts = $this->advertService->getFreshAdverts(200);

        return view('home', compact('freshAdverts'));
    }
}
