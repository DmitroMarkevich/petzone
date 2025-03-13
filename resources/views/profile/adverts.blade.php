@extends('layouts.profile')

@section('profile-content')
    <div class="adverts-container">
        @if($adverts->isEmpty())
            <div class="no-adverts">
                <p>No adverts found.</p>
            </div>
        @else
            <h2 class="page-title">Мої оголошення</h2>
            <div class="adverts-list">
                @foreach($adverts as $advert)
                    <div class="advert-item">
                        <div class="advert-left">
                            <div class="advert-image-wrapper">
                                <img src="{{ Storage::disk('s3')->url($advert->images->first()->image_path) }}"
                                     alt="{{ $advert->title }}" class="advert-image">
                            </div>

                            <div class="advert-content">
                                <h3 class="advert-title">{{ $advert->title }}</h3>
                                <p class="advert-description">{{ $advert->description }}</p>

                                <div class="advert-date-wrapper">
                                    <img src="{{ asset('images/profile/calendar.svg') }}" alt="Calendar"
                                         class="advert-date-icon">
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
                            <div class="advert-price-wrapper">
                                <span class="advert-price">{{ $advert->price }}₴</span>
                            </div>

                            <div class="advert-actions">
                                <button class="edit-btn">Редагувати</button>
                                <form action="{{ route('adverts.destroy', $advert->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Видалити</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
