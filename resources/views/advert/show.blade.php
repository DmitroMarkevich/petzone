@extends('layouts.app')

@section('title', $advert->title)

@section('app-content')
    <div class="advert-container" x-data="advertGallery()">
        <div class="breadcrumb">
            <a href="{{ route('profile.advert') }}" class="back-link">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">Назад
            </a>
            <span>/ Dogs / Food / Vitamins</span>
        </div>

        <div class="advert-main">
            <div class="advert-gallery">
                <div class="advert-slider">
                    <div class="scroll-buttons">
                        @if(count($advert->images) > 1)
                            <button class="scroll-btn left" @click="previousImage" x-show="canGoPrevious">
                                <img src="{{ asset('images/less-than.svg') }}" alt="<">
                            </button>
                        @endif

                        <div class="advert-main-image">
                            <img x-bind:src="currentImageSrc" alt="">
                        </div>

                        @if(count($advert->images) > 1)
                            <button class="scroll-btn right" @click="nextImage" x-show="canGoNext">
                                <img src="{{ asset('images/greater-than.svg') }}" alt=">">
                            </button>
                        @endif
                    </div>
                </div>
                <div class="advert-thumbnails">
                    @foreach ($advert->images as $index => $img)
                        <img src="{{ image_url($img->image_path) }}" alt=""
                             @click="setCurrentImage({{ $index }})"
                             x-bind:class="{ 'active': currentIndex === {{ $index }} }">
                    @endforeach
                </div>
            </div>

            <div class="advert-info">
                <div class="form-row">
                    <div class="advert-rating">
                        <span class="rating-value">{{ $advert->average_rating }}</span>
                        <div>
                            @for ($i = 1; $i <= 5; $i++)
                                <img src="{{ asset('images/star.svg') }}"
                                     alt="{{ $i <= $advert->average_rating ? 'Star' : 'Empty Star' }}">
                            @endfor
                        </div>
                    </div>
                    <button class="wishlist-btn">
                        <img src="{{ asset('images/heart.svg') }}" alt="Add to favorites">
                    </button>
                </div>

                <div>
                    <h2 class="advert-title">{{ $advert->title }}</h2>
                    <p class="advert-description">{{ $advert->description }}</p>
                </div>

                <div class="advert-tags">
                    @foreach($tags ?? ['Собаки', 'Їжа', "Здоров'я"] as $tag)
                        <span class="tag">#{{ $tag }}</span>
                    @endforeach
                </div>

                <div>
                    <h3 class="advert-subtitle">Options:</h3>
                    <p class="advert-text">Size/Weight/Volume, etc</p>
                </div>

                <div class="form-row" style="margin-top: auto">
                    <div class="advert-price">
                        @if($advert->shouldShowDiscountPrice())
                            <span class="old-price">{{ number_format($advert->previous_price) }} ₴</span>
                            <h4 class="new-price">{{ number_format($advert->price) }} ₴</h4>
                        @else
                            <span class="current-price">{{ number_format($advert->price) }} ₴</span>
                        @endif
                    </div>

                    <form action="{{ route('checkout.select') }}" method="POST" style="display: inline">
                        @csrf
                        <input type="hidden" name="advert_id" value="{{ $advert->id }}">
                        <button type="submit" class="buy-button">
                            Купити <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="advert-extra">
            <div class="seller-card">
                <div class="seller-header">
                    <img src="{{ $avatarUrl }}" class="seller-avatar" alt="Seller Avatar">
                    <div>
                        <a href="#" class="seller-name">
                            {{ $advert->user->first_name }} {{ $advert->user->last_name }}
                        </a>
                        <p class="seller-date">Posted: {{ $advert->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <button class="seller-btn">View number</button>
                <button class="seller-btn">View Email</button>
            </div>

            <div class="delivery-card">
                <h3 class="advert-subtitle">Delivery methods</h3>

                <div class="delivery-item">
                    <div class="delivery-content">
                        <span class="delivery-subtitle"># todo</span>
                    </div>
                </div>

                <div class="delivery-item complaint">
                    <div class="delivery-icon">
                        <img src="{{ asset('images/warning.svg') }}" alt="Warning" width="20" height="20">
                    </div>
                    <div class="form-row" style="width: 100%">
                        <span class="delivery-title">Поскаржитись на товар</span>
                        <span>arrow</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function advertGallery() {
        return {
            currentIndex: 0,
            images: [
                @foreach($advert->images as $img)
                    '{{ image_url($img->image_path) }}',
                @endforeach
            ],

            get currentImageSrc() {
                return this.images[this.currentIndex] || '{{ $advert->main_image }}';
            },

            get canGoPrevious() {
                return this.currentIndex > 0;
            },

            get canGoNext() {
                return this.currentIndex < this.images.length - 1;
            },

            setCurrentImage(index) {
                this.currentIndex = index;
            },

            previousImage() {
                if (this.canGoPrevious) {
                    this.currentIndex--;
                }
            },

            nextImage() {
                if (this.canGoNext) {
                    this.currentIndex++;
                }
            }
        }
    }
</script>












<style>
    .delivery-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
    }

    .delivery-item.complaint {
        border-top: 1px solid #f0f0f0;
        margin-top: 8px;
        padding-top: 20px;
    }

    .advert-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #555;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .advert-main {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
    }

    .advert-slider {
        position: relative;
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        z-index: 10;
        background: rgba(255, 255, 255, 0.8);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .scroll-btn:hover {
        background: rgba(255, 255, 255, 0.9);
    }

    .scroll-btn.left { left: 10px; }
    .scroll-btn.right { right: 10px; }

    .advert-main-image {
        flex: 1;
    }

    .advert-main-image img {
        width: 100%;
        height: 500px;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .advert-thumbnails {
        display: flex;
        gap: 12px;
        margin-top: 12px;
    }

    .advert-thumbnails img {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        cursor: pointer;
        transition: opacity 0.2s ease;
        border: 2px solid transparent;
    }

    .advert-thumbnails img:hover {
        opacity: 0.8;
    }

    .advert-thumbnails img.active {
        border: 0.5px solid #007bff;
    }

    .advert-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 8px;
        white-space: normal;
        word-wrap: break-word;
        word-break: break-word;
    }

    .advert-description {
        color: #555;
        white-space: normal;
        word-wrap: break-word;
        word-break: break-word;
    }

    .advert-subtitle {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .advert-text {
        color: #666;
    }

    .advert-extra {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin-top: 40px;
    }

    .seller-card, .delivery-card {
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .seller-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 16px;
    }

    .seller-name {
        font-weight: 600;
        text-decoration: none;
        color: #333;
    }

    .seller-name:hover {
        text-decoration: underline;
    }

    .seller-date {
        font-size: 13px;
        color: #777;
    }

    .seller-btn {
        width: 100%;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 10px;
        background: #fff;
        cursor: pointer;
        transition: background 0.2s ease;
        margin-top: 8px;
    }

    @media (max-width: 768px) {
        .advert-main, .advert-extra {
            grid-template-columns: 1fr;
        }
    }
</style>
