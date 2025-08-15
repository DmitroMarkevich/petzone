<?php

namespace App\Http\Controllers\Profile;

use App\Models\Order;
use App\Services\OrderService;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Auth\Access\AuthorizationException;

class OrderController extends Controller
{
    private OrderService $orderService;
    private ImageService $imageService;

    /**
     * @param OrderService $orderService
     * @param ImageService $imageService
     */
    public function __construct(OrderService $orderService, ImageService $imageService)
    {
        $this->orderService = $orderService;
        $this->imageService = $imageService;
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
        $order = Order::with([
            'buyer',
            'seller',
            'advert.images' => fn($q) => $q->where('main_image', true)
        ])->findOrFail($id);

        $this->authorize('view', $order);

        $mainImage = $this->imageService->getImageUrl($order->advert->images->first()->image_path);

        return view('profile.order-details', compact('order', 'mainImage'));
    }

    /**
     * Show the user's orders history (completed or archived orders).
     *
     * @param Request $request The HTTP request instance.
     * * @return Factory|View|Application The view displaying order history.
     */
    public function history(Request $request): Factory|View|Application
    {
        $orders = $this->orderService->getUserOrders($request->user(), false);

        return view('profile.orders-history', compact('orders'));
    }
}
