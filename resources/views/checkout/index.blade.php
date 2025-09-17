@extends('layouts.app')

@section('title', 'Оформлення замовлення')

@section('app-content')
    <div class="checkout-layout" x-data="checkoutForm()">
        <form action="{{ route('checkout.store') }}" method="POST" class="checkout-container">
            @csrf
            <input type="hidden" name="advert_id" value="{{ $advert->id }}">

            <div class="checkout-details">
                <h1>Оформлення замовлення</h1>

                <div class="container-item">
                    <h2>Замовлення</h2>
                    <x-advert.item :advert="$advert"/>
                </div>

                <div class="container-item" x-data="deliveryMethods()">
                    <h3>Доставка</h3>

                    <label for="NOVA_POST_SELF_PICKUP" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="NOVA_POST_SELF_PICKUP"
                                       name="delivery_method"
                                       value="NOVA_POST_SELF_PICKUP"
                                       x-model="selectedMethod">
                                <span class="delivery-name">{{ __('delivery.NOVA_POST_SELF_PICKUP') }}</span>
                            </span>
                            <span class="delivery-price">50 грн</span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'NOVA_POST_SELF_PICKUP'">
                            <input type="text" class="dropdown-input" placeholder="Виберіть відповідне відділення">
                            <ul class="dropdown-panel" id="nova-post-branch"></ul>
                        </div>
                    </label>

                    <label for="MEEST_SELF_PICKUP" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="MEEST_SELF_PICKUP"
                                       name="delivery_method"
                                       value="MEEST_SELF_PICKUP"
                                       x-model="selectedMethod">
                                <span class="delivery-name">{{ __('delivery.MEEST_SELF_PICKUP') }}</span>
                            </span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'MEEST_SELF_PICKUP'">
                            <input type="text" class="dropdown-input" placeholder="Виберіть відповідне відділення">
                            <ul class="dropdown-panel">
                                <li class="dropdown-item">№22003, вул. Курортна, 2</li>
                                <li class="dropdown-item">№22004, вул. Центральна, 5</li>
                                <li class="dropdown-item">№22005, вул. Лісова, 10</li>
                            </ul>
                        </div>
                    </label>

                    <label for="NOVA_POST_COURIER" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="NOVA_POST_COURIER"
                                       name="delivery_method"
                                       value="NOVA_POST_COURIER"
                                       x-model="selectedMethod">
                                <span class="delivery-name">{{ __('delivery.NOVA_POST_COURIER') }}</span>
                            </span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'NOVA_POST_COURIER'">
                            <input type="text" placeholder="Вулиця" value="Соборності">
                            <input type="text" placeholder="Будинок" value="12">
                            <input type="text" placeholder="Квартира" value="1">
                        </div>
                    </label>

                    <label for="MEEST_COURIER" class="delivery-method">
                        <div class="delivery-header">
                            <span class="radio-label">
                                <input type="radio"
                                       id="MEEST_COURIER"
                                       name="delivery_method"
                                       value="MEEST_COURIER"
                                       x-model="selectedMethod">
                                <span class="delivery-name">{{ __('delivery.MEEST_COURIER') }}</span>
                            </span>
                        </div>

                        <div class="delivery-extra" x-show="selectedMethod === 'MEEST_COURIER'">
                            <input type="text" placeholder="Вулиця" value="Соборності">
                            <input type="text" placeholder="Будинок" value="12">
                            <input type="text" placeholder="Квартира" value="1">
                        </div>
                    </label>

                    <label for="SELF_PICKUP" class="delivery-method">
                        <input type="radio"
                               id="SELF_PICKUP"
                               name="delivery_method"
                               value="SELF_PICKUP"
                               x-model="selectedMethod">
                        {{ __('delivery.SELF_PICKUP') }}
                    </label>
                </div>

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

                <div class="container-item">
                    <h3>Отримувач</h3>

                    <div class="profile-header" x-show="!editing">
                        <span class="profile-name" x-text="displayName"></span>
                        <a class="link-edit" @click="startEdit">Змінити</a>
                    </div>

                    <div class="profile-section" x-show="editing" x-transition>
                        <div class="form-row">
                            <div class="form-group">
                                <x-form.input type="text"
                                              name="recipient_first_name"
                                              label="Ім'я"
                                              x-model="form.recipient_first_name"/>
                            </div>
                            <div class="form-group">
                                <x-form.input type="text"
                                              name="recipient_last_name"
                                              label="Прізвище"
                                              x-model="form.recipient_last_name"/>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <x-form.input type="text"
                                              name="recipient_middle_name"
                                              label="По батькові"
                                              x-model="form.recipient_middle_name"/>
                            </div>
                            <div class="form-group">
                                <x-form.input type="tel"
                                              name="recipient_phone_number"
                                              label="Номер телефону"
                                              x-model="form.recipient_phone_number"/>
                            </div>
                        </div>

                        <div class="profile-actions">
                            <button class="btn-change" type="button" @click="saveChanges">Зберегти</button>
                            <button class="btn-cancel" type="button" @click="cancelEdit">Скасувати</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="checkout-summary">
                <h4 class="summary-title">Разом</h4>

                <div class="order-total">
                    <div class="form-row">
                        <p>Товар на суму</p>
                        <p class="advert-price">{{ $advert->price }}₴</p>
                    </div>

                    <div class="form-row">
                        <p>Вартість доставки</p>
                        <span>Безкоштовно</span>
                    </div>
                </div>

                <button type="submit" class="order-button">Замовлення підтверджую</button>

                <p class="order-info">
                    Отримання замовлення від 5 000 ₴ - 30 000 ₴ за наявності документів.
                    При оплаті готівкою від 30 000 ₴ необхідно надати документи для верифікації
                    згідно вимог Закону України від 06.12.2019 №361-IX
                </p>

                <div class="order-terms">
                    <p class="terms-title">Підтверджуючи замовлення, я приймаю умови:</p>
                    <ul class="terms-list">
                        <li><a href="#" class="terms-link">Положення про обробку персональних даних.</a></li>
                        <li><a href="#" class="terms-link">Угоди користувача.</a></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>

    @if ($errors->has('delivery_method'))
        <div class="error-message">
            {{ $errors->first('delivery_method') }}
        </div>
    @endif

    <script>
        function deliveryMethods() {
            return {
                selectedMethod: ''
            }
        }

        function checkoutForm() {
            return {
                editing: false,
                form: {
                    recipient_first_name: '{{ $user->first_name }}',
                    recipient_last_name: '{{ $user->last_name }}',
                    recipient_middle_name: '',
                    recipient_phone_number: '{{ $user->phone_number }}'
                },
                original: {
                    recipient_first_name: '{{ $user->first_name }}',
                    recipient_last_name: '{{ $user->last_name }}',
                    recipient_middle_name: '',
                    recipient_phone_number: '{{ $user->phone_number }}'
                },

                get displayName() {
                    const first = this.form.recipient_first_name || '';
                    const last = this.form.recipient_last_name || '';
                    return `${first} ${last}`.trim();
                },

                startEdit() {
                    this.editing = true;
                },

                saveChanges() {
    ё                    this.original = { ...this.form };
                    this.editing = false;
                },

                cancelEdit() {
                    this.form = { ...this.original };
                    this.editing = false;
                }
            }
        }
    </script>
@endsection
