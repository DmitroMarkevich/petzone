<?php

namespace App\Http\Controllers\Checkout;

use App\Models\Order;
use App\Enum\OrderStatus;
use App\Enum\PaymentMethod;
use App\Models\Advert\Advert;
use App\Services\StripeService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    private StripeService $stripeService;

    /**
     * @param StripeService $stripeService
     */
    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user();
        $advert = Advert::inRandomOrder()->first();

        return view('checkout.index', compact('user', 'advert'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $advert = Advert::findOrFail($validatedData['advert_id']);

        $paymentMethod = $validatedData['payment_method'];
        $status = match ($paymentMethod) {
            PaymentMethod::CREDIT_CARD->value => OrderStatus::PROCESSING,
            PaymentMethod::CASH_ON_DELIVERY->value => OrderStatus::PENDING,
        };

        $order = Order::create([
            'order_number' => uniqid(),
            'advert_id' => $advert->id,
            'seller_id' => $advert->owner_id,
            'buyer_id' => $request->user()->id,
            'payment_method' => $validatedData['payment_method'],
            'delivery_method' => $validatedData['delivery_method'],
            'recipient_first_name' => $validatedData['recipient_first_name'],
            'recipient_last_name' => $validatedData['recipient_last_name'],
            'recipient_middle_name' => $validatedData['recipient_middle_name'] ?? null,
            'recipient_phone_number' => $validatedData['recipient_phone_number'],
            'total_price' => $advert->price,
            'status' => $status,
        ]);

        $request->session()->put('last_order_number', $order->order_number);

        if ($paymentMethod === PaymentMethod::CREDIT_CARD->value) {
            $session = $this->stripeService->createCheckoutSession($advert, $order);
            return redirect()->away($session->url);
        }

        return redirect()->route('checkout.success');
    }

    public function success(Request $request): Factory|Application|View
    {
        return $this->showCheckoutResult($request, 'checkout.success');
    }

    public function cancel(Request $request): Factory|Application|View
    {
        return $this->showCheckoutResult($request, 'checkout.cancel');
    }

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
