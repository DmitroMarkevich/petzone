<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class ProfileData extends Data
{
    public function __construct(
        public array $userData = [],
        public array $addressData = [],
    ) {}
}
