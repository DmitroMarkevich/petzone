@extends('layouts.base')

@section('content')
    <div class="checkout-layout">
        <header class="checkout-header">
            <img src="{{ asset('images/blue-logo.svg') }}" alt="Logo">
        </header>

        <main class="checkout-container">
            <div class="checkout-details">
                <div class="checkout-section">
                    <h1>Оформлення замовлення</h1>

                    <div class="container-item">
                        <h2>Замовлення</h2>
                        <p>Продавець: {{ "$owner->first_name $owner->last_name" }}</p>
                        <x-advert-item :advert="$advert"/>
                    </div>

                    <div class="container-item">
                        <h3>Доставка</h3>

                        <x-radio-button name="delivery_method" label="Самовивіз з Нової Пошти" :checked="true"/>
                        <x-radio-button name="delivery_method" label="Самовивіз з Meest"/>
                        <x-radio-button name="delivery_method" label="Кур'єр з Нової Пошти"/>
                        <x-radio-button name="delivery_method" label="Кур'єр з Meest"/>
                    </div>

                    <div class="container-item">
                        <h3>Оплата</h3>

                        <x-radio-button name="payment" label="Оплата під час отримання товару" :checked="true"/>
                        <x-radio-button name="payment" label="Оплатити зараз"/>
                    </div>

                    <div class="container-item">
                        <h3>Отримувач</h3>

                        <div class="profile-header">
                            <span class="profile-name">{{ "$user->first_name $user->last_name" }}</span>
                            <a href="#" class="link-edit">Змінити</a>
                        </div>

                        <div class="profile-section" id="contact-info" style="display: none">
                            <div class="form-row">
                                <div class="form-group">
                                    <x-input type="text" name="first_name" label="Ім'я"
                                             value="{{ $user->first_name }}"/>
                                </div>
                                <div class="form-group">
                                    <x-input type="text" name="last_name" label="Прізвище"
                                             value="{{ $user->last_name }}"/>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <x-input type="email" name="email" label="Електронна адреса"
                                             value="{{ $user->email }}"/>
                                </div>
                                <div class="form-group">
                                    <x-input type="tel" name="phone_number" label="Номер телефону"
                                             value="{{ $user->phone_number }}"/>
                                </div>
                            </div>

                            <div class="profile-actions">
                                <button class="btn-change" id="save-btn">Зберегти</button>
                                <button class="btn-cancel" id="cancel-btn">Скасувати</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-summary">
                <h4 class="summary-title">Разом</h4>

                <div class="order-total">
                    <div class="form-row">
                        <p>Товар на суму</p>
                        <span class="advert-price">{{ $advert->price }}₴</span>
                    </div>

                    <div class="form-row">
                        <p>Вартість доставки</p>
                        <span>Безкоштовно</span>
                    </div>
                </div>

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="advert_id" value="{{ $advert->id }}">
                    <input type="hidden" name="delivery_method" id="delivery-method" value="Самовивіз з Нової Пошти">

                    <button type="submit" class="order-button">Замовлення підтверджую</button>
                </form>

                <p class="order-info">
                    Отримання замовлення від 5 000 ₴ - 30 000 ₴ за наявності документів.
                    При оплаті готівкою від 30 000 ₴ необхідно надати документи для верифікації
                    згідно вимог Закону України від 06.12.2019 №361-IX
                </p>

                <div class="order-terms">
                    <p class="terms-title">Підтверджуючи замовлення, я приймаю умови:</p>
                    <ul class="terms-list">
                        <li><a href="#" class="terms-link">положення про обробку персональних даних</a></li>
                        <li><a href="#" class="terms-link">угоди користувача</a></li>
                    </ul>
                </div>
            </div>
        </main>

        <footer class="checkout-footer">
            <p>PetZone © 2024 Всі права захищені</p>
        </footer>
    </div>
@endsection

@vite(['resources/js/checkout/index.js'])
