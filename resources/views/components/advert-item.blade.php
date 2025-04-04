<div class="advert-item">
    <div class="advert-left">
        <div class="advert-image-wrapper">
            @php
                $firstImage = $advert->images->first();
                $imageUrl = asset('images/advert-test.jpg');

                if ($firstImage && $firstImage->image_path) {
                    $imageUrl = Storage::disk('s3')->url($firstImage->image_path);
                }
            @endphp

            <img src="{{ $imageUrl }}" alt="{{ $advert->title }}" class="advert-image">
        </div>

        <div class="advert-content">
            <a class="advert-title" href="{{ route('adverts.show', $advert->id) }}">{{ $advert->title }}</a>
            <p class="advert-description">{{ $advert->description }}</p>

            <div class="advert-date-wrapper">
                <img src="{{ asset('images/profile/calendar.svg') }}" alt="Calendar" class="advert-date-icon">
                <span class="advert-date">{{ $advert->created_at->format('d.m.y') }}</span>
            </div>

            <div class="advert-tags">
                <span class="tag">#Собаки</span>
                <span class="tag">#Їжа</span>
                <span class="tag">#Здоров'я</span>
            </div>
        </div>
    </div>

    <div class="advert-right">
        <p class="advert-price">{{ $advert->price }}₴</p>

        @isset($actions)
            <div class="advert-actions">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
