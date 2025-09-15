<div class="advert-rating" role="img" aria-label="Рейтинг {{ $rating }}">
    <div class="stars-wrapper">
        @for ($i = 1; $i <= 5; $i++)
            <img src="{{ $i <= $starsToShow ? asset('images/star-filled.svg') : asset('images/star.svg') }}"
                 alt="Star">
        @endfor
    </div>
    <span class="rating-value">{{ number_format($rating, 1) }}</span>
</div>
