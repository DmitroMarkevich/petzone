<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class AdvertFilter extends Data
{
    public function __construct(
        public ?string $userId,
        public ?string $sort,
        public ?string $query,
        public ?string $category,
        public ?string $filter,
        public ?float $price_min = null,
        public ?float $price_max = null,
        public int $perPage = 10,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            userId: auth()->id(),
            sort: $validated['sort'] ?? null,
            query: $validated['query'] ?? null,
            category: $validated['category'] ?? null,
            filter: $validated['filter'] ?? null,
            price_min: $validated['price_min'] ?? null,
            price_max: $validated['price_max'] ?? null,
            perPage: $validated['perPage'] ?? 10,
        );
    }
}
