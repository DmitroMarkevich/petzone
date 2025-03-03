@extends('layouts.app')

@section('app-content')
    <div class="breadcrumb">
        <a href="#" class="back-link">← Back</a>
        <span class="category-path">Dogs / Food / Vitamins</span>
    </div>

    <div class="advert-content">
        <div class="advert-details">
            <div class="advert-gallery">
                <div class="main-image">
                    <img src="{{ Storage::disk('s3')->url($images->first()->image_path) }}" alt="Advert Image">
                </div>
                <div class="thumbnail-images">
                    @foreach ($images as $image)
                        <img src="{{ Storage::disk('s3')->url($image->image_path) }}" alt="Thumbnail">
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

                <h2 class="advert-title">{{$advert->title}}</h2>
                <p>{{$advert->description}}</p>

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
                <img id="profile-avatar"
                     src="{{ !empty($owner->image_path) ? Storage::disk('s3')->url($owner->image_path) : asset('images/default-avatar.png') }}"
                     alt="User Avatar" class="profile-avatar">

                <span class="seller-name">{{ "$owner->first_name $owner->last_name" }}</span>
                <span class="post-date">Posted: {{ $advert->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <button class="view-number">View number</button>
            <button class="view-email">View Email</button>
        </div>
    </div>
@endsection

<style>
    .advert-details {
        display: flex;
        gap: 32px;
    }

    .advert-gallery {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .main-image img {
        width: 100%;
        max-width: 400px;
        border-radius: 8px;
        background: #f0f0f0;
    }

    .thumbnail-images img {
        width: 60px;
        height: 60px;
        cursor: pointer;
    }

    .advert-info {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;

        width: 30%;
        padding: 16px;
        box-shadow: 0 4px 32px 0 #00000033;
    }

    .seller-info {
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: 32px;
    }

    .seller {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .profile-avatar {
        height: 27px !important;
        width: 27px !important;
    }
</style>
