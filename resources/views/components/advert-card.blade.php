@php
    $isInWishlist = in_array($advert->id, session('wishlist', []));
    $heartIcon = $isInWishlist ? 'images/heart-filled.svg' : 'images/heart.svg';

    $imageUrl = $advert->images->isNotEmpty()
        ? Storage::disk('s3')->url($advert->images->first()->image_path)
        : asset('images/advert-test.jpg');
@endphp

<a href="{{ route('adverts.show', $advert->id) }}">
    <div class="advert-card">
        <div class="image-container">
            <img class="advert-image" src="{{ $imageUrl }}" alt="{{ $advert->title }}">

            <form action="{{ route('wishlist.toggle', $advert->id) }}" method="POST">
                @csrf
                <button type="submit" class="favorite-button" aria-label="Додати до улюбленого">
                    <span>Додати до улюбленого</span>
                    <img src="{{ asset($heartIcon) }}" alt="Heart">
                </button>
            </form>
        </div>

        <div class="advert-details">
            <div class="advert-tags">
                <span class="tag">#Собаки</span>
                <span class="tag">#Їжа</span>
                <span class="tag">#Здоров'я</span>
            </div>

            <h3 class="advert-title">{{ $advert->title }}</h3>

            <div class="advert-rating" role="img" aria-label="{{ $advert->average_rating }}">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $advert->average_rating)
                        <img src="{{ asset('images/star.svg') }}" alt="Star">
                    @else
                        <img src="{{ asset('images/star.svg') }}" alt="Empty Star">
                    @endif
                @endfor
                <span class="rating-value">{{ $advert->average_rating }}.0</span>
            </div>
        </div>

        <div class="price-action">
            <p class="advert-price">{{ $advert->price }} ₴</p>

            <button class="buy-button" type="button">
                Купити <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart Icon">
            </button>
        </div>
    </div>
</a>
