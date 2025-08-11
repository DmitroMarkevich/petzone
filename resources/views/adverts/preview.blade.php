@extends('layouts.app')

@section('title', 'Попередній перегляд оголошення')

@section('app-content')
    <div class="advert-content">
        <div class="advert-details">
            <div class="advert-gallery">

            </div>

            <div class="advert-info">
                <div class="advert-rating">
                    @for ($i = 0; $i < 5; $i++)
                        <img src="{{ asset('images/star.svg') }}" alt="Star">
                    @endfor
                    <span class="rating-value">{{ $advert->average_rating }}</span>
                </div>

                <h2 class="advert-title">{{ $advert->title }}</h2>
                <p>{{ $advert->description }}</p>

                <div class="advert-tags">
                    <span class="tag">#Собаки</span>
                    <span class="tag">#Їжа</span>
                    <span class="tag">#Здоров'я</span>
                </div>

                <p class="advert-price">{{ $advert->price }} ₴</p>
            </div>
        </div>

        <div class="seller-info">
            <div class="seller">

                <span class="seller-name">
                    Dmytro Markevych
                </span>

                <span class="post-date">Posted: 123</span>
            </div>
        </div>
    </div>
@endsection
