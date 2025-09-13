<?php

namespace App\Http\Controllers\Checkout;

use App\DTO\OrderData;
use App\DTO\RecipientData;
use App\Enum\PaymentMethod;
use App\Models\Advert\Advert;
use App\Models\Order\Order;
use App\Services\OrderService;
use App\Services\StripeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private OrderService $orderService;
    private StripeService $stripeService;

    public function __construct(OrderService $orderService, StripeService $stripeService)
    {
        $this->orderService = $orderService;
        $this->stripeService = $stripeService;
    }

    /**
     * Display the checkout page for the currently selected advert.
     */
    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user();
        $advertId = $request->session()->get('checkout_advert_id');

        if (!$advertId) {
            abort(404);
        }

        $advert = Advert::findOrFail($advertId);

        return view('checkout.index', compact('user', 'advert'));
    }

    /**
     * Select an advert to check out and save it in the session.
     */
    public function select(Request $request): RedirectResponse
    {
        $advertId = $request->input('advert_id');
        $advert = Advert::findOrFail($advertId);

        $request->session()->put('checkout_advert_id', $advert->id);

        return redirect()->route('checkout.index');
    }

    /**
     * Store a new order and initiate payment if necessary.
     */
    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $orderData = OrderData::from($validated);
        $recipientData = RecipientData::fromRequest($validated);

        $order = $this->orderService->createOrder($request->user(), $orderData, $recipientData);

        $request->session()->put('last_order_number', $order->order_number);
        $request->session()->forget('checkout_advert_id');

        if ($order->payment_method === PaymentMethod::CREDIT_CARD->value) {
            $session = $this->stripeService->createCheckoutSession($order->advert, $order);
            return redirect()->away($session->url);
        }

        return redirect()->route('checkout.success');
    }

    /**
     * Display the success page after a completed order.
     */
    public function success(Request $request): Factory|Application|View
    {
        return $this->showCheckoutResult($request, 'checkout.success');
    }

    /**
     * Display the cancel page for a canceled order.
     */
    public function cancel(Request $request): Factory|Application|View
    {
        return $this->showCheckoutResult($request, 'checkout.cancel');
    }

    /**
     * Helper method to retrieve the last order and display the given view.
     */
    private function showCheckoutResult(Request $request, string $view): Factory|Application|View
    {
        $orderNumber = $request->session()->pull('last_order_number');

        if (!$orderNumber) {
            abort(404);
        }

        $order = Order::where('order_number', $orderNumber)
            ->where('buyer_id', auth()->id())
            ->firstOrFail();

        return view($view, ['orderId' => $order->id]);
    }
}
