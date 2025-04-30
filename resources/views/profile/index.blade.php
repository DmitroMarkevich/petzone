@extends('layouts.profile')

@section('profile-content')
    <div class="profile-container">
        <div class="profile-header">
            <img id="profile-avatar"
                 src="{{ !empty($user->image_path) ? Storage::disk('s3')->url($user->image_path) : asset('images/default-avatar.png') }}"
                 alt="Avatar" class="profile-avatar">

            <div class="profile-info">
                <h2 class="profile-greeting">Вітаємо, {{ $user->first_name }}!</h2>

                <div class="profile-actions photo">
                    <form id="photo-form" action="{{ route('profile.uploadAvatar') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile-photo" id="profile-photo" class="hidden"
                               accept=".jpeg,.png,.jpg,.svg">

                        <div class="profile-actions">
                            <button type="button" class="btn-change" id="change-photo-btn">Змінити фото</button>
                            <button type="submit" class="btn-change hidden" id="confirm-photo-btn">Зберегти</button>
                            <button type="button" class="btn-cancel hidden" id="cancel-photo-btn">Скасувати</button>
                        </div>
                    </form>

                    <form id="delete-photo-form" action="{{ route('profile.deleteAvatar') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" id="delete-photo-btn">
                            <img src="{{ asset('images/profile/bin.svg') }}" alt="Bin Icon">Видалити фото
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="profile-section my-data">
            <h4 class="section-title">
                <img src="{{ asset('images/profile/profile.svg') }}" alt="Profile" class="icon">Мої дані
            </h4>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group">
                        <x-input type="text" name="first_name" id="first-name" label="Ім'я"
                                 value="{{ $user->first_name }}" readonly/>
                    </div>
                    <div class="form-group">
                        <x-input type="text" name="last_name" id="last-name" label="Прізвище"
                                 value="{{ $user->last_name }}" readonly/>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <x-input type="email" name="email" id="email" label="Електронна адреса"
                                 value="{{ $user->email }}" readonly/>
                    </div>
                    <div class="form-group">
                        <x-input type="tel" name="phone_number" id="phone" label="Номер телефону"
                                 value="{{ $user->phone_number }}" readonly/>
                    </div>
                </div>

                <a href="" class="link-icon" id="edit-profile">
                    <img src="{{ asset('images/profile/pencil.svg') }}" alt="Редагувати" class="icon">
                    Редагувати
                </a>

                <div class="profile-actions">
                    <button type="submit" class="btn-change hidden" id="save-profile">Зберегти</button>
                    <button type="button" class="btn-cancel hidden" id="cancel-profile">Скасувати</button>
                </div>
            </form>
        </div>

        <div class="profile-section delivery-address">
            <h4 class="section-title">
                <img src="{{ asset('images/profile/address.svg') }}" alt="Адрес" class="icon">Адреса доставки
            </h4>

            <form id="address-form" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="form-row">
                    <div class="form-group">
                        <x-input type="text" name="city" label="Місто" value="{{ $address->city ?? '' }}" readonly/>
                        <ul id="city-suggestions" class="address-suggestions hidden"></ul>
                        <input type="hidden" name="ref_delivery_city" id="city-ref">
                    </div>

                    <div class="form-group">
                        <x-input type="text" name="street" label="Вулиця" value="{{ $address->street ?? '' }}" readonly/>
                        <ul id="street-suggestions" class="address-suggestions hidden"></ul>
                        <input type="hidden" name="ref_delivery_street" id="street-ref">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group apartment">
                        <x-input type="text" name="apartment" label="Квартира" value="{{ $address->apartment ?? '' }}"
                                 readonly/>
                    </div>
                </div>

                <a href="" class="link-icon" id="edit-address">
                    <img src="{{ asset('images/profile/pencil.svg') }}" alt="Редагувати" class="icon">
                    Редагувати
                </a>

                <div class="profile-actions">
                    <button type="submit" class="btn-change hidden" id="save-address">Зберегти</button>
                    <button type="button" class="btn-cancel hidden" id="cancel-address">Скасувати</button>
                </div>
            </form>
        </div>
    </div>

    @if(session('success'))
        <x-success-message :message="session('success')"/>
    @endif
@endsection

@vite(['resources/js/profile/index.js'])
