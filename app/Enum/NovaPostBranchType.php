<?php

namespace App\Enum;

enum NovaPostBranchType: string
{
    case LIMITED_POST_OFFICE = '6f8c7162-4b72-4b0a-88e5-906948c6a92f';
    case STANDARD_POST_OFFICE = '841339c7-591a-42e2-8233-7a0a00f0ed6f';
    case PRIVATBANK_LOCKER = '95dc212d-479c-4ffb-a8ab-8c1b9073d0bc';
    case CARGO_BRANCH = '9a68df70-0267-42a8-bb5c-37f427e36ee4';
    case PARCEL_LOCKER = 'f9316480-5f2d-425d-bc2c-ac7cd29decf0';

    public static function values(): array
    {
        return array_map(fn ($method) => $method->value, self::cases());
    }
}
