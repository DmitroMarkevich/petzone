@extends('layouts.app')

@section('title', 'Попередній перегляд оголошення')

@section('app-content')
    <div class="advert-container" x-data="advertGallery()" x-init="initGallery('{{ json_encode($previewImages) }}')">
        <h3 class="page-title">
            <a href="{{ route('advert.create') }}">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
            </a>
            Попередній перегляд оголошення
        </h3>

        <div class="advert-main">
            <div class="advert-gallery">
                <div class="advert-slider">
                    <div class="scroll-buttons">
                        <template x-if="images.length > 1">
                            <button class="scroll-btn left" @click="previousImage" x-show="canGoPrevious">
                                <img src="{{ asset('images/less-than.svg') }}" alt="<">
                            </button>
                        </template>

                        <div class="advert-main-image">
                            <template x-if="images.length > 0">
                                <img :src="currentImageSrc" alt="Фото оголошення">
                            </template>
                            <p x-show="images.length === 0" class="no-images">Немає фото</p>
                        </div>

                        <template x-if="images.length > 1">
                            <button class="scroll-btn right" @click="nextImage" x-show="canGoNext">
                                <img src="{{ asset('images/greater-than.svg') }}" alt=">">
                            </button>
                        </template>
                    </div>
                </div>

                <div class="advert-thumbnails" x-show="images.length > 1">
                    <template x-for="(img, index) in images" :key="index">
                        <img :src="img.data_url"
                             class="thumbnail"
                             :class="{ 'active': index === currentIndex }"
                             @click="setCurrentImage(index)">
                    </template>
                </div>
            </div>

            <div class="advert-info">
                <div class="form-row">
                    <x-advert-rating :rating="0"/>
                    <button class="wishlist-btn">
                        <img src="{{ asset('images/heart.svg') }}" alt="Add to favorites">
                    </button>
                </div>

                <div>
                    <h2 class="advert-title">{{ $advert->title }}</h2>
                    <p class="advert-description">{{ $advert->description }}</p>
                </div>

                <div class="advert-tags">
                    @foreach($tags ?? ['Тварини', 'Їжа', 'Догляд'] as $tag)
                        <span class="tag">#{{ $tag }}</span>
                    @endforeach
                </div>

                <div>
                    <h3 class="advert-subtitle">Опції:</h3>
                    <span>Size / Weight / Volume тощо</span>
                </div>

                <div class="form-row" style="margin-top: auto">
                    <div class="advert-price">
                        <span class="current-price">{{ number_format($advert->price) }} ₴</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="advert-extra">
            <div class="seller-card" x-data="{ showPhone: false, showEmail: false }">
                <x-advert.sections.seller-header
                    :seller="auth()->user()"
                    :created_at="now()->format('d/m/Y H:i')"
                />
                <x-advert.sections.contact-modal :seller="auth()->user()"/>
            </div>

            <x-advert.sections.delivery-card/>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function advertGallery() {
            return {
                images: [],
                currentIndex: 0,

                initGallery(json) {
                    try {
                        this.images = JSON.parse(json) || [];
                    } catch (e) {
                        this.images = [];
                    }
                },

                get currentImageSrc() {
                    return this.images.length ? this.images[this.currentIndex].data_url : '';
                },

                get canGoNext() {
                    return this.currentIndex < this.images.length - 1;
                },

                get canGoPrevious() {
                    return this.currentIndex > 0;
                },

                nextImage() {
                    if (this.canGoNext) this.currentIndex++;
                },

                previousImage() {
                    if (this.canGoPrevious) this.currentIndex--;
                },

                setCurrentImage(index) {
                    this.currentIndex = index;
                }
            }
        }
    </script>
@endpush
