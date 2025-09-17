@extends('layouts.app')

@section('title', $advert->title)

@section('app-content')
    <div class="advert-container" x-data="advertGallery()">
        <h3 class="page-title">
            <a href="{{ route('advert.index') }}">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
            </a>
            Повернутись назад
        </h3>

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
                        <img src="{{ image_url($img->image_path) }}" alt="" @click="setCurrentImage({{ $index }})"
                             x-bind:class="{ 'active': currentIndex === {{ $index }} }">
                    @endforeach
                </div>
            </div>

            <div class="advert-info">
                <div class="form-row">
                    <x-advert-rating :rating="$advert->average_rating"/>
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
                    <span>Size/Weight/Volume, etc</span>
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
                        <button type="submit" class="buy-button">Купити
                            <img src="{{ asset('images/profile/cart.svg') }}" alt="Cart">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="advert-extra">
            <div class="seller-card" x-data="{ showPhone: false, showEmail: false }">
                <div class="seller-header">
                    <img src="{{ image_url($advert->user->image_path, 'images/default-avatar.png') }}"
                         class="seller-avatar" alt="Seller Avatar">
                    <div>
                        <a href="#" class="seller-name">
                            {{ $advert->user->first_name }} {{ $advert->user->last_name }}
                        </a>
                        <p class="seller-date">Posted: {{ $advert->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <div x-data="{ modalOpen: false, modalContent: '', copied: false }">
                    @if($advert->user->phone)
                        <button class="seller-btn" @click="modalContent = '{{ $advert->user->phone }}'; modalOpen = true">
                            Переглянути номер телефону
                        </button>
                    @endif

                    <button class="seller-btn" @click="modalContent = '{{ $advert->user->email }}'; modalOpen = true">
                        Показати електрону пошту
                    </button>

                    <div x-show="modalOpen" x-transition class="mobile-search-modal" @click.outside="modalOpen = false" x-cloak>
                        <div class="modal-content">
                            <input type="text" x-model="modalContent" class="modal-input" readonly autofocus>
                            <button type="button" class="modal-search-btn"
                                    @click="navigator.clipboard.writeText(modalContent); copied = true; setTimeout(() => copied = false, 2000)">
                                Скопіювати
                            </button>
                            <button @click="modalOpen = false" class="modal-close-btn">&times;</button>
                            <div x-show="copied" class="copy-success-message"> Текст успішно скопійовано!</div>
                        </div>
                    </div>
                </div>
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
                        <img src="{{ asset('images/warning.svg') }}" alt="Warning">
                    </div>

                    <div class="form-row">
                        <span class="delivery-title">Поскаржитись на товар</span>
                        <span>arrow</span>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($relatedAdverts) && $relatedAdverts->isNotEmpty())
            <div class="related-adverts" x-data="scrollContainer()" x-init="init()">
                <div class="form-row">
                    <h2 class="section-title">Схожі оголошення</h2>

                    <div class="scroll-buttons">
                        <button @click="scrollLeft()" class="scroll-btn left">
                            <img src="{{ asset('images/less-than.svg') }}" alt="<">
                        </button>

                        <button @click="scrollRight()" class="scroll-btn right">
                            <img src="{{ asset('images/greater-than.svg') }}" alt=">">
                        </button>
                    </div>
                </div>

                <div class="related-adverts-list" x-ref="container">
                    @foreach($relatedAdverts as $related)
                        <x-advert-card :advert="$related" small="true"/>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

<script>
    function advertGallery() {
        return {
            currentIndex: 0,
            images: [@foreach($advert->images as $img) '{{ image_url($img->image_path) }}', @endforeach ],

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

    function scrollContainer() {
        return {
            scrollStep: 300,
            scrollLeft() {
                this.$refs.container.scrollBy({left: -this.scrollStep, behavior: 'smooth'});
            },
            scrollRight() {
                this.$refs.container.scrollBy({left: this.scrollStep, behavior: 'smooth'});
            }
        }
    }
</script>
