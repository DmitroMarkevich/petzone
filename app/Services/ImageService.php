<?php

namespace App\Services;

use App\Traits\FileUploadTrait;

class ImageService
{
    use FileUploadTrait;

    /**
     * Get the public URL of an image from storage.
     *
     * @param string|null $imagePath The path to the image in storage.
     * @param string|null $default The path to the default image to use if the image in DB doesn't exist.
     * @return string The URL of the image.
     */
    public function getImageUrl(?string $imagePath, ?string $default = null): string
    {
        if ($imagePath && $this->disk()->exists($imagePath)) {
            return $this->disk()->url($imagePath);
        }

        return $default ? asset($default) : '';
    }
}
