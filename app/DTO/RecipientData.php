<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class RecipientData extends Data
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $phone_number,
        public ?string $middle_name = null,

        public ?string $warehouse_ref = null,
        public ?string $warehouse_title = null,
        public ?string $warehouse_settlement_type = null,
        public ?string $warehouse_city = null,
        public ?string $warehouse_region = null,
    ) {}

    public static function fromRequest(array $validated): self
    {
        return new self(
            first_name: $validated['recipient_first_name'],
            last_name: $validated['recipient_last_name'],
            phone_number: $validated['recipient_phone_number'],
            middle_name: $validated['recipient_middle_name'] ?? null,

            warehouse_ref: $validated['warehouse_ref'] ?? null,
            warehouse_title: $validated['warehouse_title'] ?? null,
            warehouse_settlement_type: $validated['warehouse_settlement_type'] ?? null,
            warehouse_city: $validated['warehouse_city'] ?? null,
            warehouse_region: $validated['warehouse_region'] ?? null,
        );
    }
}
