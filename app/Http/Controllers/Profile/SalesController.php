<?php

namespace App\Http\Controllers\Profile;

use App\Enum\OrderStatus;
use App\Models\Order\Order;
use App\Http\Controllers\Controller;
use App\Services\Profile\SaleService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $status = $request->query('status');
        $sales = $this->saleService->getUserSales($request->user(), true, $status);

        return view('profile.sales', compact('sales'));
    }

    /**
     * Update the status of a specific order.
     *
     * @param Order $order The order to update.
     * @param OrderStatus $status The new status to set for the order.
     * @return RedirectResponse Redirects back to the sales index page.
     */
    public function updateStatus(Order $order, OrderStatus $status): RedirectResponse
    {
        $this->saleService->updateOrderStatus($order, $status);

        return redirect()->route('profile.sales.index');
    }
}
