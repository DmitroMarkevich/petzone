<?php

namespace App\Http\Controllers\Home;

use App\Services\AdvertService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class HomeController
{
    private AdvertService $advertService;

    /**
     * @param AdvertService $advertService
     */
    public function __construct(AdvertService $advertService)
    {
        $this->advertService = $advertService;
    }

    /**
     * Display the home page.
     *
     * @param Request $request The HTTP request instance.
     * @return Factory|View|Application The view displaying adverts on the home page.
     */
    public function index(Request $request): Factory|View|Application
    {
        $user = $request->user();

        $userWishlistIds = [];
        if ($user) {
            $userWishlistIds = $user->wishlist()->pluck('advert_id')->all();
        }

        $adverts = [
            'popularAdverts' => $this->advertService->getPopularAdverts(),
            'discountedAdverts' => $this->advertService->getDiscountedAdverts(),
            'freshAdverts' => $this->advertService->getFreshAdverts(200)
        ];

        // Add 'in_wishlist' flag to each advert based on user wishlist for frontend display
        foreach ($adverts as $key => $collection) {
            $adverts[$key] = $collection->map(function ($advert) use ($userWishlistIds) {
                $advert->in_wishlist = in_array($advert->id, $userWishlistIds);
                return $advert;
            });
        }

        return view('pages.home', compact('adverts'));
    }
}
