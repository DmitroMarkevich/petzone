<a href="{{ route('adverts.show', $advert->id) }}" class="advert-link">
    <div class="advert-card">
        <div class="image-container">
            @if($advert->images->isNotEmpty())
                <img class="advert-image" src="{{ Storage::disk('s3')->url($advert->images->first()->image_path) }}"
                     alt="{{ $advert->title }}">
            @else
                <img class="advert-image" src="{{ asset('images/advert-test.jpg') }}" alt="{{ $advert->title }}">
            @endif
            <form class="toggle-wishlist-form" action="{{ route('wishlist.toggle', $advert->id) }}" method="POST">
                @csrf
                <button type="submit" class="favorite-button">
                    <span>Додати до улюбленого</span>
                    @php
                        $isInWishlist = in_array($advert->id, session('wishlist', []));
                        $heartIcon = $isInWishlist ? 'images/heart-filled.svg' : 'images/heart.svg';
                    @endphp
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

            <div class="advert-rating">
                @for ($i = 0; $i < 5; $i++)
                    <img src="{{ asset('images/star.svg') }}" alt="Star">
                @endfor
                <span class="rating-value">0.0</span>
            </div>
        </div>

        <div class="price-action">
            <p class="advert-price">{{ $advert->price }} ₴</p>
            <button class="buy-button">
                Купити <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart Icon">
            </button>
        </div>
    </div>
</a>
