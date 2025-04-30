<?php

namespace App\Http\Controllers;

use App\Services\NovaPostService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Application;
use App\Models\Advert\Advert;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;

class CheckoutController extends Controller
{
    private OrderService $orderService;
    private NovaPostService $novaPostService;

    /**
     * @param OrderService $orderService
     * @param NovaPostService $novaPostService
     */
    public function __construct(OrderService $orderService, NovaPostService $novaPostService)
    {
        $this->orderService = $orderService;
        $this->novaPostService = $novaPostService;
    }

    /**
     * Display the checkout page.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $user = auth()->user();
        $advert = Advert::inRandomOrder()->first();

        return view('checkout.index', compact('user', 'advert'));
    }

    /**
     * Store a new order in the system.
     *
     * @param StoreOrderRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->orderService->createOrder($validatedData);

        return redirect()->route('profile.orders');
    }
}
