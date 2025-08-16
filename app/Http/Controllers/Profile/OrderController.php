<?php

namespace App\Http\Controllers\Profile;

use App\Services\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Auth\Access\AuthorizationException;

class OrderController extends Controller
{
    private OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a list of the user's active orders.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying active orders.
     */
    public function index(Request $request): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders($request->user(), true);

        return view('profile.orders', compact('orders'));
    }

    /**
     * Show the details of a specific order.
     *
     * @param string $id The ID of the order to display.
     * @return Factory|View|Application The view displaying order details.
     * @throws AuthorizationException If the user is not authorized to view the order.
     */
    public function show(string $id): Factory|View|Application
    {
        $order = $this->orderService->getOrderById($id);
        $this->authorize('view', $order);

        return view('profile.order-details', compact('order'));
    }

    /**
     * Show the user's orders history (completed or archived orders).
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying order history.
     */
    public function history(Request $request): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders($request->user(), false);

        return view('profile.orders-history', compact('orders'));
    }
}
