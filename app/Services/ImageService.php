<?php

namespace App\Services;

use App\Traits\FileUploadTrait;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class ImageService
{
    use FileUploadTrait;

    public function getMainImageUrl(Model $entity, ?string $default = null, string $relation = 'images'): string
    {
        $related = $entity->{$relation};

        $imagePath = null;
        if ($related instanceof Collection) {
            $imagePath = $related->first()?->image_path;
        }

        return $this->getImageUrl($imagePath, $default);
    }

    public function getAllImageUrls(Model $entity, string $relation = 'images'): array
    {
        $related = $entity->{$relation};

        if ($related instanceof Collection) {
            return $related
                ->pluck('image_path')
                ->filter()
                ->map(fn($path) => $this->disk()->url($path))
                ->values()
                ->toArray();
        }

        if ($related instanceof Model) {
            $url = $this->getImageUrl($related->image_path);
            return $url ? [$url] : [];
        }

        return [];
    }

    public function getImageUrl(?string $imagePath, ?string $default = null): string
    {
        if ($imagePath && $this->disk()->exists($imagePath)) {
            return $this->disk()->url($imagePath);
        }

        return $default ? asset($default) : '';
    }
}
