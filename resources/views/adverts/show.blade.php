@extends('layouts.app')

@section('title', $advert->title)

@section('app-content')
    <div class="page-container">
        <div class="breadcrumb">
            <a href="{{ route('profile.adverts') }}">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
            </a>
            <span class="category-path">Dogs / Food / Vitamins</span>
        </div>

        <div class="advert-content">
            <div class="advert-details">
                <div class="advert-gallery">
                    <div class="main-image">
                        <img src="{{ $mainImageUrl }}" alt="Advert Image">
                    </div>

                    <div class="thumbnail-images">
                        @foreach ($thumbnailUrls as $url)
                            <img src="{{ $url }}" alt="Thumbnail">
                        @endforeach
                    </div>
                </div>

                <div class="advert-info">
                    <div class="advert-rating">
                        @for ($i = 0; $i < 5; $i++)
                            <img src="{{ asset('images/star.svg') }}" alt="Star">
                        @endfor
                        <span class="rating-value">0.0</span>
                    </div>

                    <h2 class="advert-title">{{ $advert->title }}</h2>
                    <p>{{ $advert->description }}</p>

                    <div class="advert-tags">
                        <span class="tag">#Собаки</span>
                        <span class="tag">#Їжа</span>
                        <span class="tag">#Здоров'я</span>
                    </div>

                    <div class="form-row">
                        <p class="advert-price">{{ $advert->price }} ₴</p>
                        <button class="buy-button">
                            Купити <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart Icon">
                        </button>
                    </div>
                </div>
            </div>

            <div class="seller-info">
                <div class="seller">
                    <img id="profile-avatar" src="{{ $avatarUrl  }}" alt="User Avatar" class="profile-avatar">
                    <span class="seller-name">{{ $advert->user->first_name }} {{ $advert->user->last_name }}</span>
                    <span class="post-date">Posted: {{ $advert->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <button class="view-number">View number</button>
                <button class="view-email">View Email</button>
            </div>
        </div>
    </div>
@endsection
