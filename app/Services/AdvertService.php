<?php

namespace App\Services;

use App\DTO\AdvertData;
use App\Models\Advert\Advert;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
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
    public function getAdverts(?string $query = null, ?string $userId = null, ?string $sort = null, int $perPage = 10): LengthAwarePaginator
    {
        $builder = $query ? Advert::search($query) : Advert::query();

        $sortOptions = [
            'relevance' => fn($q) => $q,
            'price-asc'  => fn($q) => $q->orderBy('price', 'asc'),
            'price-desc' => fn($q) => $q->orderBy('price', 'desc'),
            'date-asc'   => fn($q) => $q->orderBy('created_at', 'desc'),
        ];

        if ($sort && isset($sortOptions[$sort])) {
            $builder = $sortOptions[$sort]($builder);
        } elseif (!$query) {
            $builder = $builder->inRandomOrder();
        }

        $paginator = $builder->paginate($perPage);
        $paginator->getCollection()->load([
            'images' => fn($q) => $q->where('main_image', true),
            'wishlists' => fn($q) => $q->when($userId, fn($q) => $q->where('user_id', $userId)),
        ]);

        return $paginator;
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

    /**
     * Create a new advert from a DTO and attach uploaded images.
     */
    public function createAdvert(AdvertData $data, array $images = []): Advert
    {
        $advert = Advert::create([...$data->toModelAttributes(), 'owner_id' => auth()->id()]);

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
     * Get popular advert, ordered by the number of wishlists.
     */
    public function getPopularAdverts(int $limit = 10): Collection
    {
        return $this->cacheService->remember("advert:popular:$limit", fn() =>
            $this->baseAdvertQuery()
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
        return $this->cacheService->remember("advert:discounted:$limit", fn() =>
            $this->baseAdvertQuery()
                ->whereColumn('previous_price', '>', 'price')
                ->take($limit)
                ->get()
        );
    }

    /**
     * Get recently created advert within a time frame.
     */
    public function getFreshAdverts(int $hours = 5, int $limit = 5): Collection
    {
        $cacheMinutes = 30;

        return $this->cacheService->remember("advert:fresh:$limit", fn() =>
            $this->baseAdvertQuery()
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
