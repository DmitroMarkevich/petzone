<?php

namespace App\View\Components;

use App\Models\Advert\Advert;
use Closure;
use Illuminate\View\View;
use Illuminate\View\Component;

class AdvertCard extends Component
{
    public Advert $advert;

    /**
     * Create a new component instance.
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $heartIcon = $this->advert->inWishlist
            ? asset('images/heart-filled.svg')
            : asset('images/heart.svg');

        return view('components.advert.card', [
            'advert' => $this->advert,
            'heartIcon' => $heartIcon,
        ]);
    }
}
