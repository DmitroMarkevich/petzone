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
     *
     * If a search query is provided, full-text search is used.
     * Otherwise, adverts are returned in random order.
     *
     * @param string|null $query The search query, or null for random adverts.
     * @param int $perPage Number of adverts per page. Default is 10.
     * @return LengthAwarePaginator Paginated collection of adverts.
     */
    public function getAdverts(?string $query = null, ?string $userId = null, ?string $sort = null, int $perPage = 10): LengthAwarePaginator
    {
        $builder = $query ? Advert::search($query) : Advert::query();

        $sortOptions = [
            'price-asc'  => fn($q) => $q->orderBy('price', 'asc'),
            'price-desc' => fn($q) => $q->orderBy('price', 'desc'),
            'date-asc'   => fn($q) => $q->orderBy('created_at', 'desc'),
        ];

        if ($sort && isset($sortOptions[$sort])) {
            $builder = $sortOptions[$sort](Advert::query());
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
     *
     * @param Advert $advert Advert to update.
     * @param AdvertData $dto DTO containing updated advert information.
     * @return bool True if the advert was successfully saved.
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
     *
     * @param AdvertData $dto DTO containing advert data and uploaded images.
     * @return Advert The newly created advert.
     */
    public function createAdvert(AdvertData $dto): Advert
    {
        $advert = Advert::create(array_merge($dto->toModelAttributes(), ['owner_id' => auth()->id()]));

        foreach ($dto->images as $index => $image) {
            $this->addAdvertImage($advert, $image, $index === 0);
        }

        return $advert;
    }

    /**
     * Upload a file in storage and create an advert image record.
     *
     * @param Advert $advert The advert to attach the image to.
     * @param UploadedFile $file The uploaded image file.
     * @param bool $mainImage Whether this image is the main image.
     */
    protected function addAdvertImage(Advert $advert, UploadedFile $file, bool $mainImage = false): void
    {
        $directory = "adverts/$advert->id";
        $imagePath = $this->uploadFile($directory, $file);

        $advert->images()->create([
            'image_path' => $imagePath,
            'main_image' => $mainImage,
        ]);
    }

    /**
     * Get popular adverts, ordered by the number of wishlists.
     *
     * @param int $limit Number of adverts to return.
     * @return Collection
     */
    public function getPopularAdverts(int $limit = 10): Collection
    {
        return $this->cacheService->remember("adverts:popular:$limit", fn() =>
            $this->baseAdvertQuery()
                ->withCount('wishlists')
                ->orderByDesc('wishlists_count')
                ->limit($limit)
                ->get()
        );
    }

    /**
     * Get discounted adverts where previous price is higher than current price.
     *
     * @param int $limit Number of adverts to return.
     * @return Collection
     */
    public function getDiscountedAdverts(int $limit = 5): Collection
    {
        return $this->cacheService->remember("adverts:discounted:$limit", fn() =>
            $this->baseAdvertQuery()
                ->whereColumn('previous_price', '>', 'price')
                ->take($limit)
                ->get()
        );
    }

    /**
     * Get recently created adverts within a time frame.
     *
     * @param int $hours Time frame in hours for "fresh" adverts.
     * @param int $limit Number of adverts to return.
     * @return Collection
     */
    public function getFreshAdverts(int $hours = 5, int $limit = 5): Collection
    {
        $cacheMinutes = 30;

        return $this->cacheService->remember("adverts:discounted:$limit", fn() =>
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
     *
     * @return Builder
     */
    private function baseAdvertQuery(): Builder
    {
        return Advert::select('id', 'title', 'price', 'previous_price', 'average_rating')
            ->withMainImage();
    }
}
