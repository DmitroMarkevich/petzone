<?php

namespace App\Http\Controllers;

use App\Services\WishlistService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WishlistController extends Controller
{
    private WishlistService $wishlistService;

    /**
     * @param WishlistService $wishlistService
     */
    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $wishlist = $this->wishlistService->getWishlist();

        return view('profile.wishlist', compact('wishlist'));
    }

    /**
     * Toggle the ad in the wishlist.
     */
    public function toggleWishlist(string $advertId): RedirectResponse
    {
        $this->wishlistService->toggleWishlist($advertId);

        return redirect()->back();
    }
}
