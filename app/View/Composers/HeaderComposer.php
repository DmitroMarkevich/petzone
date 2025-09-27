<?php

namespace App\View\Composers;

use App\Services\CategoryService;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class HeaderComposer
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function compose(View $view): void
    {
        $user = Auth::user();

        $wishlistCount = $user ? $user->wishlist()->count() : 0;
        $ordersCount = $user ? $user->orders()->count() : 0;
        $categories = $this->categoryService->getTree();

        $view->with([
            'wishlistCount' => $wishlistCount,
            'ordersCount' => $ordersCount,
            'headerCategories' => $categories,
        ]);
    }
}
