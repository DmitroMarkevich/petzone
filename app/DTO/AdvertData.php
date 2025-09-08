<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class AdvertData extends DataTransferObject
{
    public string $title;

    public string $description;

    public float $price;

    public string $category_id;

    /** @var UploadedFile[] */
    public array $images = [];

    public function toModelAttributes(): array
    {
        return [
            'title'        => $this->title,
            'description'  => $this->description,
            'price'        => $this->price,
            'category_id'  => $this->category_id,
        ];
    }
}
