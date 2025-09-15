<?php

namespace App\Services;

use App\Models\User;
use App\DTO\AdvertData;
use App\Models\Advert\Advert;
use App\Enum\AdvertSortOption;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Collection;
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

    /**
     * Get a paginated list of adverts with images and wishlist relations.
     * If a search query is provided, full-text search is used.
     * Otherwise, adverts are returned in random order.
     */
    public function getAdverts(
        ?string $query = null,
        ?string $userId = null,
        ?string $sort = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        $builder = $this->buildAdvertQuery($query, $sort);

        $paginator = $builder->paginate($perPage);
        $paginator->getCollection()->load([
            'images' => fn($q) => $q->where('main_image', true),
            'wishlists' => fn($q) => $q->when($userId, fn($q) => $q->where('user_id', $userId)),
        ]);

        return $paginator;
    }

    /**
     * Build the advert query based on search query and sorting.
     */
    private function buildAdvertQuery(?string $query, ?string $sort): Builder
    {
        $builder = $query ? Advert::search($query) : Advert::query();
        $sortOption = AdvertSortOption::tryFromRequest($sort);

        if ($sortOption) {
            return $sortOption->apply($builder);
        }

        return $query ? $builder : $builder->inRandomOrder();
    }

    /**
     * Create a new advert from a DTO and attach uploaded images.
     */
    public function createAdvert(AdvertData $data, User $user, array $images = []): Advert
    {
        $advert = Advert::create([...$data->toModelAttributes(), 'owner_id' => $user->id]);

        if (!empty($images)) {
            $directory = "advert/$advert->id";

            foreach ($images as $index => $image) {
                if ($image) {
                    $imagePath = $this->uploadFile($directory, $image);
                    $advert->images()->create(['image_path' => $imagePath, 'main_image' => $index === 0]);
                }
            }
        }

        return $advert;
    }

    /**
     * Update an existing advert using data from a DTO.
     */
    public function updateAdvert(Advert $advert, AdvertData $dto): bool
    {
        if ($dto->price < $advert->price) {
            $advert->previous_price = $advert->price;
            $advert->price_changed_at = now();
        }

        $advert->fill($dto->toModelAttributes());

        return $advert->save();
    }

    public function getRelatedAdverts(Advert $advert, float $priceTolerance = 0.5): Collection {
        $priceRange = [
            $advert->price * (1 - $priceTolerance),
            $advert->price * (1 + $priceTolerance)
        ];

        return $this->baseAdvertQuery()
            ->where('id', '!=', $advert->id)
            ->where('category_id', $advert->category_id)
            ->whereBetween('price', $priceRange)
            ->orderByRaw('ABS(price - ?) ASC, created_at DESC', [$advert->price])
            ->limit(5)
            ->get();
    }

    /**
     * Get popular advert, ordered by the number of wishlists.
     */
    public function getPopularAdverts(int $limit = 10): Collection
    {
        return $this->cacheService->remember("advert:popular:$limit", fn() => $this->baseAdvertQuery()
            ->withCount('wishlists')
            ->orderByDesc('wishlists_count')
            ->limit($limit)
            ->get()
        );
    }

    /**
     * Get discounted advert where previous price is higher than current price.
     */
    public function getDiscountedAdverts(int $limit = 5): Collection
    {
        return $this->cacheService->remember("advert:discounted:$limit", fn() => $this->baseAdvertQuery()
            ->whereColumn('previous_price', '>', 'price')
            ->limit($limit)
            ->get()
        );
    }

    /**
     * Get recently created advert within a time frame.
     */
    public function getFreshAdverts(int $hours = 5, int $limit = 5): Collection
    {
        $cacheMinutes = 30;

        return $this->cacheService->remember("advert:fresh:$limit", fn() => $this->baseAdvertQuery()
            ->where('created_at', '>=', now()->subHours($hours))
            ->latest()
            ->take($limit)
            ->get(),
            $cacheMinutes
        );
    }

    /**
     * Base query builder for adverts with default fields and main image.
     */
    private function baseAdvertQuery(): Builder
    {
        return Advert::select('id', 'title', 'price', 'previous_price', 'average_rating')
            ->withMainImage();
    }
}
