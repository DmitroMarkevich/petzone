@extends('layouts.profile')

@section('title', 'Мої продажі')

@section('profile-content')
    @if($sales->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="sales-container">
            <h2 class="page-title">Мої продажі</h2>

            <x-filter-buttons :items="$sales->getCollection()" :filters="[
                ['key' => 'status', 'value' => 'PENDING', 'label' => 'Очікують підтвердження'],
                ['key' => 'status', 'value' => 'CONFIRMED', 'label' => 'Підтверджені'],
                ['key' => 'status', 'value' => 'CANCELED', 'label' => 'Відхилені']
            ]"/>

            <div class="adverts-list">
                @forelse($sales as $sale)
                    @continue(!$sale->advert)

                    <div class="advert-item" data-status="{{ $sale->status->value }}">
                        <div class="advert-left">
                            <div class="advert-image-wrapper">
                                <img src="{{ $sale->main_image }}" class="advert-image" alt="{{ $sale->advert->title }}">
                            </div>

                            <div class="advert-content">
                                <a class="advert-title" href="{{ route('adverts.show', $sale->advert->id) }}">
                                    {{ $sale->advert->title }}
                                </a>

                                <p>Служба
                                    доставки: {{ \App\Enum\DeliveryMethod::getTranslation($sale->delivery_method) }}</p>

                                <button type="button" class="toggle-details">Розгорнути</button>
                            </div>
                        </div>

                        <div class="advert-right">
                            <p class="advert-price">{{ $sale->advert->price }}₴</p>

                            @if($sale->status->value == \App\Enum\OrderStatus::PENDING->value)
                                <div class="advert-actions">
                                    <form action="{{ route('profile.sales.confirm', $sale->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="edit-btn">Підтвердити</button>
                                    </form>

                                    <form action="{{ route('profile.sales.reject', $sale->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="delete-btn">Відхилити</button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div class="advert-details" style="display: none;">
                            <div>
                                <p>Покупець</p>
                                <p>Ім'я {{ $sale->buyer->first_name }}</p>
                                <p>Прізвище {{ $sale->buyer->last_name }}</p>
                                <p>Номер Телефону {{ $sale->buyer->phone_number }}</p>
                            </div>

                            <div>
                                <p>Разом</p>
                                <p>Ціна {{ $sale->total_price }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Продажі відсутні.</p>
                @endforelse

                @if($sales->hasPages())
                    {{ $sales->links() }}
                @endif
            </div>
        </div>
    @endif
@endsection
