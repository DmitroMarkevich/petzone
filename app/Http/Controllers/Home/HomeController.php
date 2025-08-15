<?php

namespace App\Http\Controllers\Home;

use App\Services\ImageService;
use App\Services\AdvertService;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;

class HomeController
{
    private AdvertService $advertService;
    private ImageService $imageService;

    /**
     * @param AdvertService $advertService
     * @param ImageService $imageService
     */
    public function __construct(AdvertService $advertService, ImageService $imageService)
    {
        $this->advertService = $advertService;
        $this->imageService = $imageService;
    }

    /**
     * Display the home page.
     *
     * @return Factory|View|Application The view displaying adverts on the home page.
     */
    public function index(): Factory|View|Application
    {
        $freshAdverts = $this->advertService->getFreshAdverts(200, 5);
        $popularAdverts = $this->advertService->getFreshAdverts(200, 10);
        $discountedAdverts = $this->advertService->getFreshAdverts(200, 5);

        $userWishlists = auth()->check() ? auth()->user()->wishlist()->pluck('advert_id')->all() : [];

        $advertsList = [$freshAdverts, $popularAdverts, $discountedAdverts];

        foreach ($advertsList as &$adverts) {
            $collection = method_exists($adverts, 'getCollection') ? $adverts->getCollection() : $adverts;

            $collection->transform(function ($advert) use ($userWishlists) {
                $mainImagePath = $advert->images->first()?->image_path;
                $advert->main_image = $this->imageService->getImageUrl($mainImagePath);
                $advert->in_wishlist = in_array($advert->id, $userWishlists);
                return $advert;
            });
        }

        return view('home', compact('freshAdverts', 'popularAdverts', 'discountedAdverts'));
    }
}
