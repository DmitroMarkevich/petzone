<?php

namespace App;

use UnitEnum;

interface Translatable
{
    /**
     * Get the translated label for an enum case.
     *
     * @param UnitEnum $method The enum case to translate.
     * @return string The translated label.
     */
    public static function getTranslation(UnitEnum $method): string;
}
