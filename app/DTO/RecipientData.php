<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RecipientData extends DataTransferObject
{
    public string $first_name;

    public string $last_name;

    public ?string $middle_name;

    public string $phone_number;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(array $validated): self
    {
        return new self([
            'first_name'   => $validated['recipient_first_name'],
            'last_name'    => $validated['recipient_last_name'],
            'middle_name'  => $validated['recipient_middle_name'] ?? null,
            'phone_number' => $validated['recipient_phone_number'],
        ]);
    }
}
