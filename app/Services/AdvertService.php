<?php

namespace App\Services;

use App\Models\Advert\Advert;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

// todo: need to be refactored
class AdvertService
{
    use FileUploadTrait;

    // todo fix bugs
    public function getAdverts(?string $query = null, int $perPage = 10, ?int $userId = null): LengthAwarePaginator
    {
        $with = ['images'];
        if ($userId) {
            $with['wishlists'] = fn($q) => $q->where('user_id', $userId);
        }

        $queryBuilder = $query ? Advert::search($query) : Advert::query();

        return $queryBuilder
            ->with($with)
            ->when(!$query, fn($q) => $q->inRandomOrder())
            ->paginate($perPage);
    }

    public function updateAdvert(string $id, array $data): bool
    {
        $advert = Advert::findOrFail($id);
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
            foreach ($data['images'] as $image) {
                $this->addAdvertImage($advert, $image);
            }
        }

        return $advert;
    }

    protected function addAdvertImage(Advert $advert, UploadedFile $file): void
    {
        $directory = "adverts/$advert->id";
        $imagePath = $this->uploadFile($directory, $file);

        $advert->images()->create(['image_path' => $imagePath]);
    }

    public function getFreshAdverts(int $hours = 5, int $limit = 4)
    {
        return Advert::select('id', 'title', 'price')
            ->with(['images' => fn($q) => $q->where('main_image', true)])
            ->where('created_at', '>=', now()->subHours($hours))
            ->latest()
            ->take($limit)
            ->get();
    }
}
