@extends('layouts.profile')

@section('profile-content')
    <div class="record-container">
        <h2 class="page-title">
            <a href="{{ route('profile.orders') }}">
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
                        <img class="order-image" src="{{ asset('images/advert-test.jpg') }}" alt="Advert Image">
                        <div class="order-item-details">
                            <h4>Корм для собак</h4>
                            <p>Spiky Beef</p>
                        </div>
                    </div>
                    <span>1</span>
                    <div class="status {{ strtolower($order->status->value) }}">
                        {{ \App\Enum\OrderStatus::getTranslation($order->status) }}
                    </div>
                    <span>{{ $order->tracking_number ?: __('N/A') }}</span>
                    <span>₴{{ $order->total_price }}</span>
                </div>
            </div>

            <div class="info-block">
                <h3 class="section-heading">Адреса доставки</h3>

                <div class="form-row">
                    <div class="contact-details">
                        <p>Київ, Відділення №32</p>
                        <p>вул. Набережно-Хрещатицька, 33</p>
                    </div>

                    <a href="https://www.google.com/maps/search/?api=1&query=Київ, Відділення №32, вул. Набережно-Хрещатицька, 33"
                       class="link-icon">
                        <img src="{{ asset('images/location-pin.svg') }}" alt="">Подивитися в Google Maps
                    </a>
                </div>
            </div>

            <div>
                <h3 class="section-heading">Відправник</h3>

                <div class="form-row">
                    <div class="contact-details">
                        <p>Дуда Іван Вікторович</p>
                        <p>+123456789</p>
                    </div>

                    <a href="tel:+123456789" class="link-icon">
                        <img src="{{ asset('images/contact-phone.svg') }}" alt="">Подзвонити відправнику
                    </a>
                </div>
            </div>

            <div>
                <h3 class="section-heading">Одержувач</h3>

                <div class="contact-details">
                    <p>Джміль Марта Юріївна</p>
                    <p>+123456789</p>
                </div>
            </div>
        </div>
    </div>
@endsection
