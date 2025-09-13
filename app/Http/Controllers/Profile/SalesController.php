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

    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function index(Request $request): Factory|View|Application
    {
        $status = $request->query('status');
        $sales = $this->saleService->getUserSales($request->user(), true, $status);

        return view('profile.sales', compact('sales'));
    }

    public function updateStatus(Order $order, OrderStatus $status): RedirectResponse
    {
        $updatedStatus = $this->saleService->updateOrderStatus($order, $status);

        $messages = [
            'CONFIRMED' => 'Замовлення підтверджено',
            'CANCELED'  => 'Замовлення відхилено',
        ];

        return redirect()->route('profile.sales.index')
            ->with('success', $messages[$updatedStatus->value]);
    }
}
