<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\Profile\WishlistService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;

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
     * Display the authenticated user's wishlist.
     *
     * @param Request $request The HTTP request instance.
     * @return View The view displaying the user's wishlist.
     */
    public function index(Request $request): View
    {
        $wishlist = $this->wishlistService->getUserWishlist($request->user(), $request->get('sort'));

        return view('profile.wishlist', compact('wishlist'));
    }

    /**
     * Toggle an advert in the authenticated user's wishlist.
     *
     * @param Request $request The HTTP request instance.
     * @param string $advertId The ID of the advert to toggle.
     * @return JsonResponse JSON response indicating whether the advert is now in the wishlist.
     */
    public function toggleWishlist(Request $request, string $advertId): JsonResponse
    {
        $inWishlist = $this->wishlistService->toggleWishlist($request->user(), $advertId);

        return response()->json(['in_wishlist' => $inWishlist]);
    }
}
