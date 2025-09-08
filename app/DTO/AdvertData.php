<?php

namespace App\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Illuminate\Http\UploadedFile;

class AdvertData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public float $price,
        public string $category_id,
        #[DataCollectionOf(UploadedFile::class)]
        public array $images = [],
    ) {}

    public function toModelAttributes(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'category_id' => $this->category_id,
        ];
    }
}
