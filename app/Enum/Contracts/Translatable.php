<?php

namespace App\Enum\Contracts;

use UnitEnum;

interface Translatable
{
    /**
     * Returns a human-readable translation for a given enum case.
     */
    public static function getTranslation(UnitEnum $method): string;
}
