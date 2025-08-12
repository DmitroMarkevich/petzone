@php
    $isInWishlist = \Illuminate\Support\Facades\Auth::user()->wishlist()->where('advert_id', $advert->id)->exists();

    $heartIcon = $isInWishlist ? 'images/heart-filled.svg' : 'images/heart.svg';

    $imageUrl = $advert->images->isNotEmpty()
        ? Storage::disk('s3')->url($advert->images->first()->image_path)
        : asset('images/advert-test.jpg');
@endphp

<div class="advert-card">
    <a href="{{ route('adverts.show', $advert->id) }}" class="advert-link">
        <div class="image-container">
            <a href="{{ route('adverts.show', $advert->id) }}" class="advert-link">
                <img class="advert-image" src="{{ $imageUrl }}" alt="{{ $advert->title }}">
            </a>

            <form class="wishlist-form" data-action="{{ route('wishlist.toggle', $advert->id) }}"
                  data-id="{{ $advert->id }}">
                @csrf
                <button type="button" class="favorite-button" data-id="{{ $advert->id }}">
                    <img src="{{ asset($heartIcon) }}" alt="Heart" class="heart-icon" data-id="{{ $advert->id }}">
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
    </a>
</div>
