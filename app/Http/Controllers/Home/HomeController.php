<?php

namespace App\Http\Controllers\Home;

use App\Services\Advert\AdvertService;
use App\Services\Advert\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class HomeController
{
    private AdvertService $advertService;
    private CategoryService $categoryService;

    public function __construct(AdvertService $advertService, CategoryService $categoryService)
    {
        $this->advertService = $advertService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display the home page.
     */
    public function index(Request $request): Factory|View|Application
    {
        $adverts = [
            'popularAdverts' => $this->advertService->getPopularAdverts(),
            'discountedAdverts' => $this->advertService->getDiscountedAdverts(),
            'freshAdverts' => $this->advertService->getFreshAdverts(200)
        ];

        $userWishlistIds = $request->user()
            ->wishlist()
            ->pluck('advert_id')
            ->all();

        // Add 'in_wishlist' flag to each advert based on user wishlist for frontend display
        foreach ($adverts as $key => $collection) {
            $adverts[$key] = $collection->map(function ($advert) use ($userWishlistIds) {
                $advert->in_wishlist = in_array($advert->id, $userWishlistIds);
                return $advert;
            });
        }

        $categories = $this->categoryService->getParents();

        return view('home', compact(['adverts', 'categories']));
    }
}
