@extends('layouts.app')

@section('title', 'Оформлення замовлення')

@section('app-content')
    <div class="checkout-layout">
        <form action="{{ route('checkout.store') }}" method="POST" class="checkout-container">
            @csrf
            <input type="hidden" name="advert_id" value="{{ $advert->id }}">

            <div class="checkout-details">
                <h1>Оформлення замовлення</h1>

                <x-advert.item :advert="$advert"/>
                <x-pages.checkout.delivery-methods/>

                <div class="container-item">
                    <h3>Оплата</h3>

                    @foreach (\App\Enum\PaymentMethod::cases() as $method)
                        <x-form.radio-button name="payment_method"
                                             id="{{ $method->value }}"
                                             value="{{ $method->value }}"
                                             label="{{ \App\Enum\PaymentMethod::getTranslation($method) }}"
                                             class="payment-method"/>
                    @endforeach
                </div>

                <x-pages.checkout.recipient-form :user="$user"/>
            </div>

            <x-pages.checkout.checkout-summary :advert="$advert"/>
        </form>
    </div>

    <x-form.error for="delivery_method"/>
@endsection
