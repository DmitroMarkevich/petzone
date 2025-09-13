<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use App\Services\StripeWebhookService;
use UnexpectedValueException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use Stripe\Exception\SignatureVerificationException;

class StripeWebhookController extends Controller
{
    private StripeWebhookService $stripeWebhookService;

    /**
     * @param StripeWebhookService $stripeWebhookService
     */
    public function __construct(StripeWebhookService $stripeWebhookService)
    {
        $this->stripeWebhookService = $stripeWebhookService;
    }

    /**
     * Handles the Stripe webhook via StripeWebhookService.
     */
    public function handle(Request $request): Response|JsonResponse|ResponseFactory
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');

        try {
            $event = $this->stripeWebhookService->constructEvent($payload, $sigHeader);
        } catch (UnexpectedValueException) {
            return response('Invalid payload', 400);
        }

        $this->stripeWebhookService->handleEvent($event);

        return response()->json(['status' => 'success']);
    }
}
