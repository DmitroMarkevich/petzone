<?php

namespace App\Services;

use App\Models\Advert\Category;
use Illuminate\Support\Collection;

class CategoryService
{
    protected int $cacheTtl = 60 * 60 * 24 * 7;

    protected CacheService $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function getTree(): Collection
    {
        return $this->cacheService->remember('categories_menu', function () {
            return $this->buildTree(Category::orderBy('name')->get());
        }, $this->cacheTtl);
    }

    private function buildTree(Collection $categories, $parentId = null): Collection
    {
        // Find "parent" categories (parent_id == null) to build the tree with children
        return $categories->where('parent_id', $parentId)->map(function ($category) use ($categories) {
            $children = $this->buildTree($categories, $category->id);

            // Attach children to parent
            $category->setRelation('children', $children);
            return $category;
        });
    }
}
