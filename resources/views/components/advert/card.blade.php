<div class="advert-card">
    <div class="image-container">
        <a href="{{ route('adverts.show', $advert->id) }}" class="advert-link">
            <img class="advert-image" src="{{ $advert->mainImage }}" alt="{{ $advert->title }}">
        </a>

        <form class="wishlist-form" data-action="{{ route('wishlist.toggle', $advert->id) }}"
              data-id="{{ $advert->id }}">
            @csrf
            <button type="button" class="favorite-button" data-id="{{ $advert->id }}">
                Додати до улюбленого
                <img src="{{ $heartIcon }}" alt="Heart" class="heart-icon" data-id="{{ $advert->id }}">
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
            @for ($i = 1; $i <= 5; $i++)
                <img src="{{ asset('images/star.svg') }}"
                     alt="{{ $i <= $advert->average_rating ? 'Star' : 'Empty Star' }}">
            @endfor
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
            <button class="buy-button" type="submit">
                Купити <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart Icon">
            </button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).on('click', '.favorite-button', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $button = $(this);
        if ($button.prop('disabled')) return;

        const $form = $button.closest('.wishlist-form');
        const $icon = $button.find('.heart-icon');

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $button.prop('disabled', true);

        $.ajax({
            url: $form.data('action'),
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken },
            success: function(response) {
                $icon.attr('src', `/images/${response.in_wishlist ? 'heart-filled.svg' : 'heart.svg'}`);
            }, complete: function() {
                $button.prop('disabled', false);
            }
        });
    });
</script>
