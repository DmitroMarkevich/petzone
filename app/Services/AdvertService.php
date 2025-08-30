<?php

namespace App\Services;

use App\Models\Advert\Advert;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

// todo: need to be refactored; need to add methods with popular and discounted adverts (with redis)
class AdvertService
{
    use FileUploadTrait;

    private const DEFAULT_PER_PAGE = 10;

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
    public function getAdverts(?string $query = null, int $perPage = self::DEFAULT_PER_PAGE, ?string $userId = null): LengthAwarePaginator
    {
        $queryBuilder = Advert::query();

        if ($query) {
            $queryBuilder->where(function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%");
            });
        } else {
            $queryBuilder->orderBy('random_seed');
        }

        $queryBuilder->with([
            'images' => fn($q) => $q->where('main_image', true),
            'wishlists' => fn($q) => $userId ? $q->where('user_id', $userId) : $q->whereRaw('1 = 0')
        ]);

        return $queryBuilder->paginate($perPage);
    }

    public function updateAdvert(string $id, array $data): bool
    {
        $advert = Advert::findOrFail($id);

        if ($data['price'] < $advert->price) {
            $data['previous_price'] = $advert->price;
            $data['price_changed_at'] = now();
        }

        return $advert->update($data);
    }

    public function createAdvert(array $data): Advert
    {
        $advert = Advert::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'owner_id' => auth()->id(),
        ]);

        if (isset($data['images']) && is_array($data['images'])) {
            foreach ($data['images'] as $index => $image) {
                $this->addAdvertImage($advert, $image, $index === 0);
            }
        }

        return $advert;
    }

    protected function addAdvertImage(Advert $advert, UploadedFile $file, bool $mainImage = false): void
    {
        $directory = "adverts/$advert->id";
        $imagePath = $this->uploadFile($directory, $file);

        $advert->images()->create([
            'image_path' => $imagePath,
            'main_image' => $mainImage,
        ]);
    }

    public function getFreshAdverts(int $hours = 5, int $limit = 4): Collection
    {
        return Advert::withMainImage()
            ->where('created_at', '>=', now()->subHours($hours))
            ->latest()
            ->take($limit)
            ->get();
    }

    // todo
    public function getPopularAdverts(int $limit = 4): \Illuminate\Support\Collection
    {
        return collect();
    }

    // todo
    public function getDiscountedAdverts(int $limit = 4): Collection
    {
        return Advert::withMainImage()
            ->whereNotNull('previous_price')
            ->whereColumn('previous_price', '>', 'price')
            ->orderBy('random_seed')
            ->take($limit)
            ->get();
    }
}
