<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class AdvertData extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public float $price,
        public string $category_id,
        public string $advert_condition,
        public string $advert_type,
    ) {}

    public function toModelAttributes(): array
    {
        return [
            'title'            => $this->title,
            'description'      => $this->description,
            'price'            => $this->price,
            'category_id'      => $this->category_id,
            'advert_condition' => $this->advert_condition,
            'advert_type'      => $this->advert_type,
        ];
    }
}
