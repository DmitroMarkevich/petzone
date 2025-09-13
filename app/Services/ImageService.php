<?php

namespace App\Services;

use App\Traits\FileUploadTrait;

class ImageService
{
    use FileUploadTrait;

    /**
     * Get the public URL of an image from storage.
     */
    public function getImageUrl(?string $imagePath, ?string $default = null): string
    {
        if ($imagePath && $this->disk()->exists($imagePath)) {
            return $this->disk()->url($imagePath);
        }

        return $default ? asset($default) : '';
    }
}
