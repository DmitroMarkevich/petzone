@extends('layouts.profile')

@section('profile-content')
    @if($sales->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="sales-container">
            <h2 class="page-title">Мої продажі</h2>

            <div class="filter-buttons">
                <button class="filter-button active">Всі ({{ $sales->count() }})</button>
                <button class="filter-button" data-status="pending">
                    Очікують підтвердження ({{ $sales->where('status', 'PENDING')->count() }})
                </button>
                <button class="filter-button" data-status="confirmed">
                    Підтверджені ({{ $sales->where('status', 'CONFIRMED')->count() }})
                </button>
                <button class="filter-button" data-status="canceled">
                    Відхилені ({{ $sales->where('status', 'CANCELED')->count() }})
                </button>
            </div>

            <div class="adverts-list">
                @foreach($sales as $order)
                    @if($order->advert)
                        @php
                            $status = strtolower($order->status->value);

                            $firstImage = $order->advert->images->first();
                            $imageUrl = $firstImage && $firstImage->image_path
                                ? Storage::disk('s3')->url($firstImage->image_path)
                                : asset('images/advert-test.jpg');
                        @endphp

                        <div class="advert-item" data-status="{{ $status }}" x-data="{ open: false }">
                            <div class="advert-left">
                                <div class="advert-image-wrapper">
                                    <img src="{{ $imageUrl }}" alt="{{ $order->advert->title }}"
                                         class="advert-image">
                                </div>

                                <div class="advert-content">
                                    <a class="advert-title" href="{{ route('adverts.show', $order->advert->id) }}">
                                        {{ $order->advert->title }}
                                    </a>

                                    <p>Служба доставки: {{ $order->delivery_method }}</p>

                                    <button type="button" class="toggle-details" @click="open = !open">
                                        <span x-text="open ? 'Згорнути' : 'Розгорнути'">Розгорнути</span>
                                    </button>
                                </div>
                            </div>

                            <div class="advert-right">
                                <p class="advert-price">{{ $order->advert->price }}₴</p>

                                @if($order->is_active)
                                    <div class="advert-actions">
                                        <a href class="edit-btn">Підтвердити</a>

                                        <button type="submit" class="delete-btn">Відхилити</button>
                                    </div>
                                @endif
                            </div>

                            <div class="advert-details" x-show="open" x-transition x-cloak>
                                <div>
                                    <p>Покупець</p>
                                    <p>Ім'я {{ $order->buyer->first_name }}</p>
                                    <p>Прізвище {{ $order->buyer->last_name }}</p>
                                    <p>Номер Телефону {{ $order->buyer->phone_number }}</p>
                                </div>

                                <div>
                                    <p>Разом</p>
                                    <p>Ціна {{ $order->total_price }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    @vite('resources/js/pages/profile/statusFilter.js')
@endpush
