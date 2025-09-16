<?php

namespace App\DTO;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Arr;
use Spatie\LaravelData\Data;
use App\Http\Requests\UpdateProfileRequest;

class ProfileData extends Data
{
    public function __construct(
        public array $userData = [],
        public array $addressData = [],
    ) {}

    public static function fromRequest(UpdateProfileRequest $request): self
    {
        $data = $request->validated();

        return new self(
            userData: Arr::only($data, (new User())->getFillable()),
            addressData: Arr::only($data, (new Address())->getFillable()),
        );
    }
}
