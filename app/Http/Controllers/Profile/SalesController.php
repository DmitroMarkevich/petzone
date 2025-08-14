<?php

namespace App\Http\Controllers\Profile;

use App\Models\Order;
use App\Enum\OrderStatus;
use App\Services\ImageService;
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
    private ImageService $imageService;

    /**
     * @param SaleService $saleService
     * @param ImageService $imageService
     */
    public function __construct(SaleService $saleService, ImageService $imageService)
    {
        $this->imageService = $imageService;
        $this->saleService = $saleService;
    }

    /**
     * Display a list of the user's sales.
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory|View|Application
    {
        $sales = $this->saleService->getUserSales($request->user(), true);

        $sales->getCollection()->transform(function ($order) {
            $order->advert_main_image_url = $this->imageService->getMainImageUrl(
                $order->advert,
                'images/advert-test.jpg'
            );

            return $order;
        });

        return view('profile.sales', compact('sales'));
    }

    /**
     * Update the status of a specific order.
     * Finds the order by its ID and updates its status using the SaleService.
     *
     * @param string $orderId
     * @param OrderStatus $status
     *
     * @return RedirectResponse
     */
    public function updateStatus(string $orderId, OrderStatus $status): RedirectResponse
    {
        $order = Order::findOrFail($orderId);
        $this->saleService->updateOrderStatus($order, $status);

        return redirect()->route('profile.sales.index');
    }
}
