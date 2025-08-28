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
use Stripe\Exception\ApiErrorException;

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

    /**
     * Display the checkout page for the currently selected advert.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying the checkout form.
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
     * Select an advert еo check out and save it in the session.
     *
     * @param Request $request The HTTP request instance containing 'advert_id'.
     * @return RedirectResponse Redirects to the checkout page.
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
     *
     * @param StoreOrderRequest $request Validated form request containing order data.
     * @return RedirectResponse Redirects to Stripe payment or success page.
     * @throws ApiErrorException Thrown if Stripe Checkout session creation fails.
     */
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
        $request->session()->forget('checkout_advert_id');

        if ($paymentMethod === PaymentMethod::CREDIT_CARD->value) {
            $session = $this->stripeService->createCheckoutSession($advert, $order);
            return redirect()->away($session->url);
        }

        return redirect()->route('checkout.success');
    }

    /**
     * Display the success page after a completed order.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|Application|View The view displaying order success.
     */
    public function success(Request $request): Factory|Application|View
    {
        return $this->showCheckoutResult($request, 'checkout.success');
    }

    /**
     * Display the cancel page for a canceled order.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|Application|View The view displaying order cancellation.
     */
    public function cancel(Request $request): Factory|Application|View
    {
        return $this->showCheckoutResult($request, 'checkout.cancel');
    }

    /**
     * Helper method to retrieve the last order and display the given view.
     *
     * @param Request $request The HTTP request instance.
     * @param string $view The name of the view to render.
     * @return Factory|Application|View The view with order data.
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
