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
    ) {}
}
