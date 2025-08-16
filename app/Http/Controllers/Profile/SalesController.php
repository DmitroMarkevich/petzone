<?php

namespace App\Http\Controllers\Profile;

use App\Models\Order;
use App\Enum\OrderStatus;
use App\Services\Profile\SaleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class SalesController extends Controller
{
    private SaleService $saleService;

    /**
     * @param SaleService $saleService
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a list of the user's sales.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying active sales.
     */
    public function index(Request $request): Factory|View|Application
    {
        $sales = $this->saleService->getUserSales($request->user(), true);

        return view('profile.sales', compact('sales'));
    }

    /**
     * Update the status of a specific order.
     *
     * @param string $orderId The ID of the order to update.
     * @param OrderStatus $status The new status to set for the order.
     * @return RedirectResponse Redirects back to the sales index page.
     */
    public function updateStatus(string $orderId, OrderStatus $status): RedirectResponse
    {
        $order = Order::findOrFail($orderId);
        $this->saleService->updateOrderStatus($order, $status);

        return redirect()->route('profile.sales.index');
    }
}
