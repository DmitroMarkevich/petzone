<div class="advert-item" data-status="{{ $status ?? '' }}">
    <div class="advert-main">
        <div class="advert-left">
            <div class="advert-image-wrapper">
                <img src="{{ $advert->main_image }}" alt="{{ $advert->title }}" class="advert-image">
            </div>

            <div class="advert-content">
                <a class="advert-title" href="{{ route('adverts.show', $advert->id) }}">{{ $advert->title }}</a>
                <p class="advert-description">{{ $advert->description }}</p>

                <div class="advert-date-wrapper">
                    <img src="{{ asset('images/profile/calendar.svg') }}" alt="Calendar">
                    <span class="advert-date">{{ $advert->created_at->format('d.m.y') }}</span>
                </div>

                <div class="advert-tags">
                    @foreach($tags ?? ['Собаки', 'Їжа', "Здоров'я"] as $tag)
                        <span class="tag">#{{ $tag }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="advert-right">
            <p class="advert-price">{{ $advert->price }}₴</p>

            @if(!empty($actions))
                <div class="advert-actions">{{ $actions }}</div>
            @endif
        </div>
    </div>
</div>
