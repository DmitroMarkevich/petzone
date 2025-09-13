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

    public function __construct(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    public function index(Request $request): View
    {
        $wishlist = $this->wishlistService->getUserWishlist($request->user(), $request->input('sort'));

        return view('profile.wishlist', compact('wishlist'));
    }

    public function toggleWishlist(Request $request, string $advertId): JsonResponse
    {
        $inWishlist = $this->wishlistService->toggleWishlist($request->user(), $advertId);

        return response()->json(['in_wishlist' => $inWishlist]);
    }
}
