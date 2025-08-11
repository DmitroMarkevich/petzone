<?php

namespace App\Services;

use App\Models\Advert\Advert;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;

class AdvertService
{
    use FileUploadTrait;

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
        return Advert::where('created_at', '>=', now()->subHours($hours))
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }
}
