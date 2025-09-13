<?php

namespace App\Models\Advert;

use App\Models\Image;

class AdvertImage extends Image
{
    protected $casts = [
        'main_image' => 'boolean',
    ];

    /**
     * Extends the fillable attributes of the base Image class
     * by adding 'main_image' and 'advert_id'.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['main_image', 'advert_id']);
    }
}
