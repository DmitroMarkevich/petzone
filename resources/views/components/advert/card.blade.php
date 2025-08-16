<div class="advert-card">
    <div class="image-container">
        <a href="{{ route('adverts.show', $advert->id) }}" class="advert-link">
            <img class="advert-image" src="{{ $advert->mainImage }}" alt="{{ $advert->title }}">
        </a>

        <form class="wishlist-form" data-action="{{ route('wishlist.toggle', $advert->id) }}"
              data-id="{{ $advert->id }}">
            @csrf
            <button type="button" class="favorite-button" data-id="{{ $advert->id }}">
                <img src="{{ $heartIcon }}" alt="Heart" class="heart-icon" data-id="{{ $advert->id }}">
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
                <img src="{{ asset('images/star.svg') }}"
                     alt="{{ $i <= $advert->average_rating ? 'Star' : 'Empty Star' }}">
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

