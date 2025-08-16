<?php

namespace App\Models\Advert;

use App\Models\Image;

class AdvertImage extends Image
{
    /**
     * Casts attributes to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'main_image' => 'boolean',
    ];

    /**
     * AdvertImage constructor.
     *
     * Extends the fillable attributes of the base Image class
     * by adding 'main_image' and 'advert_id'.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mergeFillable(['main_image', 'advert_id']);
    }
}
