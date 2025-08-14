<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Advert\Advert;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Services\Delivery\NovaPostService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

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
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user();
        $advert = Advert::inRandomOrder()->first();

        return view('checkout.index', compact('user', 'advert'));
    }

    /**
     * Store a new order in the system.
     *
     * @param StoreOrderRequest $request
     * @return RedirectResponse
     * @throws \Exception
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $this->orderService->createOrder($request->user(), $validatedData);

        return redirect()->route('profile.orders.index');
    }
}
