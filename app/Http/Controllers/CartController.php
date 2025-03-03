<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    private CartService $cartService;

    /**
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(): View
    {
        $cartItems = $this->cartService->getCartItems();
        return view('cart.index', compact('cartItems'));
    }

    public function addToCart($advertId): RedirectResponse
    {
        if (!$this->cartService->addToCart($advertId)) {
            return redirect()->back()->with('message', 'Оголошення вже в корзині.');
        }

        return redirect()->back()->with('success', 'Оголошення додано в корзину.');
    }

    public function removeFromCart(int $advertId): RedirectResponse
    {
        $this->cartService->removeFromCart($advertId);

        return redirect()->back();
    }
}
