<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class AddressData extends Data
{
    public function __construct(
        public string $city,
        public string $city_ref,
        public ?string $present,
        public ?string $area,
        public ?string $parent_region_code,
        public ?string $parent_region_types,
        public ?string $settlement_type_code,
        public ?string $street,
        public ?string $apartment,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            city: $validated['city'],
            city_ref: $validated['city_ref'],
            present: $validated['present'] ?? null,
            area: $validated['area'] ?? null,
            parent_region_code: $validated['parent_region_code'] ?? null,
            parent_region_types: $validated['parent_region_types'] ?? null,
            settlement_type_code: $validated['settlement_type_code'] ?? null,
            street: $validated['street'] ?? null,
            apartment: $validated['apartment'] ?? null,
        );
    }
}
