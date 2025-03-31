<?php

namespace App;

interface Translatable
{
    /**
     * Get the translated label for a method.
     *
     * @param string $method The delivery method to translate.
     * @return string The translated label for the method.
     */
    public static function getTranslation(string $method): string;
}
