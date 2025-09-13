<div class="advert-card">
    <div class="image-container">
        <a href="{{ route('advert.show', $advert->id) }}">
            <img class="advert-image" src="{{ $advert->mainImage }}" alt="{{ $advert->title }}">
        </a>

        <form class="wishlist-form" data-action="{{ route('wishlist.toggle', $advert->id) }}">
            @csrf
            <button type="button" class="favorite-button" data-id="{{ $advert->id }}" data-active="{{ $isInWishlist ? 'true' : 'false' }}">
                Додати до улюбленого <img src="{{ $heartIcon }}" alt="Heart">
            </button>
        </form>
    </div>

    <div class="advert-details">
        <div class="advert-tags">
            @foreach($tags ?? ['Собаки', 'Їжа', "Здоров'я"] as $tag)
                <span class="tag">#{{ $tag }}</span>
            @endforeach
        </div>

        <h3 class="advert-title">{{ $advert->title }}</h3>

        <div class="advert-rating" role="img" aria-label="{{ $advert->average_rating }}">
            <div class="stars-wrapper">
                @for ($i = 1; $i <= 5; $i++)
                    <img src="{{ $i <= $starsToShow ? asset('images/star-filled.svg') : asset('images/star.svg') }}"
                         alt="Star">
                @endfor
            </div>
            <span class="rating-value">{{ $advert->average_rating }}</span>
        </div>
    </div>

    <div class="price-action">
        <div class="advert-price">
            @if($advert->shouldShowDiscountPrice())
                <span class="old-price">{{ number_format($advert->previous_price) }} ₴</span>
                <h4 class="new-price">{{ number_format($advert->price) }} ₴</h4>
            @else
                <span class="current-price">{{ number_format($advert->price) }} ₴</span>
            @endif
        </div>

        <form action="{{ route('checkout.select') }}" method="POST">
            @csrf
            <input type="hidden" name="advert_id" value="{{ $advert->id }}">
            <button class="buy-button" type="submit">Купити
                <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart Icon">
            </button>
        </form>
    </div>
</div>
