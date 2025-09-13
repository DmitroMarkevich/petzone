<?php

namespace App\Http\Controllers\Profile;

use App\Models\Order\Order;
use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders($request->user(), true);

        return view('profile.orders.index', compact('orders'));
    }

    public function show(Order $order): Factory|View|Application
    {
        $this->authorize('view', $order);

        return view('profile.orders.show', compact('order'));
    }

    /**
     * Display a list of user's past orders (order history).
     */
    public function history(Request $request): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders($request->user(), false);

        return view('profile.orders.history', compact('orders'));
    }
}
