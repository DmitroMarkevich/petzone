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
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $wishlist = $this->wishlistService->getWishlist($request->user());

        return view('profile.wishlist', compact('wishlist'));
    }

    /**
     * Toggle the advert in the wishlist.
     *
     * @param Request $request
     * @param string $advertId Advert ID for wishlist toggle.
     * @return JsonResponse
     */
    public function toggleWishlist(Request $request, string $advertId): JsonResponse
    {
        $inWishlist = $this->wishlistService->toggleWishlist($request->user(), $advertId);

        return response()->json(['in_wishlist' => $inWishlist]);
    }
}
