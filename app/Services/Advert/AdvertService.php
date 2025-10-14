<?php

namespace App\Services\Advert;

use App\Models\User;
use App\DTO\AdvertData;
use App\DTO\AdvertFilter;
use App\Models\Advert\Advert;
use App\Services\CacheService;
use App\Traits\FileUploadTrait;
use App\Services\Advert\Builders\SearchBuilder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AdvertService
{
    use FileUploadTrait;

    private CacheService $cacheService;
    private SearchBuilder $searchBuilder;

    public function __construct(CacheService $cacheService, SearchBuilder $searchBuilder)
    {
        $this->cacheService = $cacheService;
        $this->searchBuilder = $searchBuilder;
    }

    public function getAdverts(AdvertFilter $filter): LengthAwarePaginator
    {
        $builder = $this->searchBuilder->build($filter);

        $paginator = $builder->paginate($filter->perPage);
        $paginator->getCollection()->load([
            'images' => fn($q) => $q->where('main_image', true),
            'wishlists' => fn($q) => $q->when($filter->userId, fn($q) => $q->where('user_id', $filter->userId)),
        ]);

        return $paginator;
    }

    public function createAdvert(AdvertData $data, User $user, array $images = []): Advert
    {
        return DB::transaction(function () use ($data, $user, $images) {
            $advert = Advert::create([...$data->toArray(), 'owner_id' => $user->id]);
            $this->attachImagesToAdvert($advert, $images);
            return $advert;
        });
    }

    private function attachImagesToAdvert(Advert $advert, array $images): void
    {
        foreach (array_filter($images) as $index => $image) {
            $advert->images()->create([
                'image_path' => $this->uploadFile("advert/$advert->id", $image),
                'main_image' => $index === 0,
            ]);
        }
    }

    public function updateAdvert(Advert $advert, AdvertData $dto): bool
    {
        $attributes = $dto->toArray();

        if ($dto->price < $advert->price) {
            $attributes['previous_price'] = $advert->price;
            $attributes['price_changed_at'] = now();
        }

        $advert->fill($attributes);

        return $advert->save();
    }

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
        return $this->cacheService->remember("popular:$limit", fn() => $this->advertBaseQuery()
            ->withCount('wishlists')
            ->orderByDesc('wishlists_count')
            ->limit($limit)
            ->get()
        );
    }

    public function getDiscountedAdverts(int $limit = 5): Collection
    {
        return $this->cacheService->remember("discounted:$limit", fn() => $this->advertBaseQuery()
            ->discounted()
            ->limit($limit)
            ->get()
        );
    }

    public function getFreshAdverts(int $hours = 5, int $limit = 5): Collection
    {
        return $this->cacheService->remember("fresh:$limit", fn() => $this->advertBaseQuery()
                ->where('created_at', '>=', now()->subHours($hours))
                ->latest()
                ->limit($limit)
                ->get(),
            ttl: 30
        );
    }

    private function advertBaseQuery(): Builder
    {
        return Advert::select('id', 'title', 'price', 'previous_price', 'average_rating')
            ->withMainImage();
    }
}
