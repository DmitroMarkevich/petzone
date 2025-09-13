<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\View;
use Illuminate\View\Component;
use App\Models\Advert\Advert;

class AdvertCard extends Component
{
    public Advert $advert;
    public int $starsToShow;
    public string $heartIcon;
    public bool $isInWishlist;

    /**
     * Create a new component instance.
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;

        $rating = $advert->average_rating ?? 0;
        $whole = floor($rating);
        $this->starsToShow = (int) ($rating - $whole) > 0.6 ? $whole + 1 : $whole;

        $this->isInWishlist = $this->advert->in_wishlist;
        $this->heartIcon = $this->isInWishlist ? asset('images/heart-filled.svg') : asset('images/heart.svg');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advert.card', [
            'advert' => $this->advert,
            'heartIcon' => $this->heartIcon,
            'starsToShow' => $this->starsToShow,
            'isInWishlist' => $this->isInWishlist
        ]);
    }
}
