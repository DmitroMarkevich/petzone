<?php

namespace App\Services;

use App\Models\Advert\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    private CacheService $cacheService;

    /**
     * @param CacheService $cacheService
     */
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function getAll(): Collection
    {
        return $this->cacheService->remember('advert.categories', function () {
            return Category::all();
        });
    }
}
