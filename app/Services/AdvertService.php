<?php

namespace App\Services;

use App\Models\User;
use App\DTO\AdvertData;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use App\Enum\AdvertSortOption;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
class AdvertService
{
    use FileUploadTrait;

    private CacheService $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function getAdverts(
        ?string $query = null,
        ?string $userId = null,
        ?string $sort = null,
        ?string $category = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        $builder = $query ? Advert::search($query) : Advert::query();

        if ($category) {
            $categoryModel = Category::where('slug', $category)->first();

            if ($categoryModel) {
                if ($categoryModel->children()->exists()) {
                    $ids = $categoryModel->children()->pluck('id')->toArray();
                    $ids[] = $categoryModel->id;

                    $builder->whereIn('category_id', $ids);
                } else {
                    $builder->where('category_id', $categoryModel->id);
                }
            }
        }

        $sortOption = AdvertSortOption::tryFromRequest($sort);

        if ($sortOption) {
            $builder = $sortOption->apply($builder);
        } elseif (!$query && !$category) {
            $builder = $builder->inRandomOrder();
        }

        $paginator = $builder->paginate($perPage)->appends([
            'query'    => $query,
            'sort'     => $sort,
            'category' => $category,
        ]);

        $paginator->getCollection()->load([
            'images' => fn($q) => $q->where('main_image', true),
            'wishlists' => fn($q) => $q->when($userId, fn($q) => $q->where('user_id', $userId)),
        ]);

        return $paginator;
    }

    public function createAdvert(AdvertData $data, User $user, array $images = []): Advert
    {
        return DB::transaction(function () use ($data, $user, $images) {
            $advert = Advert::create([
                ...$data->toModelAttributes(),
                'owner_id' => $user->id,
            ]);

            collect($images)
                ->filter(fn($image) => !empty($image))
                ->values()
                ->each(fn($image, $i) => $advert->images()->create([
                    'image_path' => $this->uploadFile("advert/$advert->id", $image),
                    'main_image' => $i === 0,
                ]));

            return $advert;
        });
    }

    public function updateAdvert(Advert $advert, AdvertData $dto): bool
    {
        if ($dto->price < $advert->price) {
            $advert->fill([
                'previous_price' => $advert->price,
                'price_changed_at' => now(),
            ]);
        }

        return $advert->fill($dto->toModelAttributes())->save();
    }

    /**
     * Get related adverts:
     * - Same category, excluding current advert
     * - Price within ±$tolerance (0.5 = ±50%)
     */
    public function getRelatedAdverts(Advert $advert, float $tolerance = 0.5, int $limit = 5): Collection
    {
        return $this->advertBaseQuery()
            ->where('id', '!=', $advert->id)
            ->where('category_id', $advert->category_id)
            ->whereBetween('price', [
                $advert->price * (1 - $tolerance),
                $advert->price * (1 + $tolerance),
            ])
            ->limit($limit)
            ->get();
    }

    public function getPopularAdverts(int $limit = 10): Collection
    {
        return $this->cacheService->remember("fresh:$limit", fn() =>
            $this->advertBaseQuery()
                ->withCount('wishlists')
                ->orderByDesc('wishlists_count')
                ->limit($limit)
                ->get()
        );
    }

    public function getDiscountedAdverts(int $limit = 5): Collection
    {
        return $this->cacheService->remember("fresh:$limit", fn() =>
            $this->advertBaseQuery()
                ->whereColumn('previous_price', '>', 'price')
                ->limit($limit)
                ->get()
        );
    }

    public function getFreshAdverts(int $hours = 5, int $limit = 5): Collection
    {
        return $this->cacheService->remember("fresh:$limit", fn() =>
            $this->advertBaseQuery()
                ->where('created_at', '>=', now()->subHours($hours))
                ->latest()
                ->limit($limit)
                ->get(),
            ttl: 30
        );
    }

    public function addInWishlistFlag($adverts, $userWishlistIds)
    {
        return $adverts->map(function ($advert) use ($userWishlistIds) {
            $advert->in_wishlist = in_array($advert->id, $userWishlistIds);
            return $advert;
        });
    }

    private function advertBaseQuery(): Builder
    {
        return Advert::select('id', 'title', 'price', 'previous_price', 'average_rating')
            ->withMainImage();
    }
}
