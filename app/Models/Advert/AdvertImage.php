<?php

namespace App\Models\Advert;

use App\Models\Image;

class AdvertImage extends Image
{
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['main_image', 'advert_id']);
    }

    public function isMain(): bool
    {
        return (bool) $this->main_image;
    }
}
