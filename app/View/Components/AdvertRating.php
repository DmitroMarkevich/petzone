<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AdvertRating extends Component
{
    public int $starsToShow;
    public float $rating;

    /**
     * Create a new component instance.
     */
    public function __construct(float $rating = 0.0)
    {
        $this->rating = $rating;

        $whole = floor($rating);
        $this->starsToShow = ($rating - $whole) > 0.6 ? $whole + 1 : $whole;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.advert.rating');
    }
}
