@php
    $recipient = $order->recipient;
@endphp

@extends('layouts.profile')

@section('title', 'Деталі замовлення')

@section('profile-content')
    <div class="record-container">
        <h2 class="page-title">
            <a href="{{ route('profile.orders.index') }}">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
            </a>
            Деталі замовлення
        </h2>

        <div class="order-details">
            <div class="order-container">
                <div class="order-header">
                    <span>Замовлення</span>
                    <span>Кількість</span>
                    <span>Статус відправлення</span>
                    <span>Номер</span>
                    <span>Ціна</span>
                </div>

                <div class="order-item-row">
                    <div class="order-item-info">
                        <img class="order-image" src="{{ $order->advert->mainImage }}"
                             alt="{{ $order->advert->title }}">

                        <div class="order-item-details">
                            <h4>{{ $order->advert->title }}</h4>
                            <p>Spiky Beef</p>
                        </div>
                    </div>

                    <span>1</span>
                    <div class="status {{ strtolower($order->status->value) }}">
                        {{ \App\Enum\OrderStatus::getTranslation($order->status) }}
                    </div>
                    <span>{{ $order->tracking_number ?? __('N/A') }}</span>
                    <span>₴{{ $order->total_price }}</span>
                </div>
            </div>

            <div class="form-row">
                <div class="contact-details">
                    <h3 class="section-heading">Адреса доставки</h3>

                    @php
                        $settlementType = $recipient->warehouse_settlement_type ?? '';
                        $city = $recipient->warehouse_city ?? '';
                        $region = $recipient->warehouse_region ?? '';
                        $title = $recipient->warehouse_title ?? '';

                        $firstLine = trim("$settlementType $city, $region область");
                        $secondLine = $title;

                        $mapQuery = urlencode("$firstLine, $secondLine");
                    @endphp

                    @if($firstLine)
                        <p>{{ $firstLine }}</p>
                    @endif

                    @if($secondLine)
                        <p>{{ $secondLine }}</p>
                    @endif
                </div>

                @if($firstLine || $secondLine)
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $mapQuery }}"
                       class="link-icon" target="_blank">
                        <img src="{{ asset('images/location-pin.svg') }}" alt="">Подивитися в Google Maps
                    </a>
                @endif
            </div>

            <div class="form-row">
                <div class="contact-details">
                    <h3 class="section-heading">Відправник</h3>
                    <p>{{ "{$order->seller->last_name} {$order->seller->first_name}" }}</p>
                    <p>{{ $order->seller->phone_number ?? 'N/A'}}</p>
                </div>
                @if($order->seller->phone_number)
                    <a href="tel:{{ $order->seller->phone_number }}" class="link-icon">
                        <img src="{{ asset('images/contact-phone.svg') }}" alt="">Подзвонити
                    </a>
                @endif
            </div>

            <div class="contact-details">
                <h3 class="section-heading">Одержувач</h3>
                <p>{{ "$recipient->first_name $recipient->last_name $recipient->middle_name" }}</p>
                <p>{{ $recipient->phone_number }}</p>
            </div>
        </div>
    </div>
@endsection
