<?php

namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ProfileData extends DataTransferObject
{
    public array $userData = [];

    public array $addressData = [];
}
