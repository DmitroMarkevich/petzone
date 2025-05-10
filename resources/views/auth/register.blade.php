@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">{{ __('auth.register.heading') }}</h2>
            <p class="auth-subheading">{{ __('auth.register.subheading') }}</p>
        </div>

        <form id="registration-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="step step-1 active">
                <div class="form-group">
                    <x-input type="email" name="email"
                             label="{{ __('auth.register.email') }}" placeholder="Email"
                             data-validation="email"/>

                    <x-input type="password" name="password"
                             label="{{ __('auth.register.password') }}" placeholder="********"
                             data-validation="password"/>

                    <x-input type="password" name="password_confirmation"
                             label="{{ __('auth.register.password_confirmation') }}" placeholder="********"
                             data-validation="password"/>
                </div>

                <div>
                    <button type="button" class="button next-step">{{ __('auth.register.next') }}</button>
                    @include('components.social-buttons')
                </div>

                <div class="auth-link">
                    <p>{{ __('auth.register.login_text') }}
                        <a href="{{ route('login') }}">{{ __('auth.register.login_link') }}</a>
                    </p>
                </div>
            </div>

            <div class="step step-2">
                <div class="photo-upload">
                    <div id="photo-background" class="photo-background">
                        <img id="preview-image" src="{{ asset('images/auth/upload-photo.svg') }}" alt="Upload photo">
                    </div>
                    <input id="profile-photo" type="file" name="logo" accept=".jpeg,.png,.jpg,.svg" hidden>
                </div>

                <div class="form-group">
                    <x-input type="text" name="first_name" label="{{ __('auth.register.first_name') }}"
                             placeholder="{{ __('auth.register.first_name_placeholder') }}"/>

                    <x-input type="text" name="last_name" label="{{ __('auth.register.last_name') }}"
                             placeholder="{{ __('auth.register.last_name_placeholder') }}"/>

                    <x-input type="tel" name="phone_number" label="{{ __('auth.register.phone_number') }}"
                             placeholder="{{ __('auth.register.phone_number_placeholder') }}"/>
                </div>

                <button type="submit" class="button submit">{{ __('auth.register.confirm_button') }}</button>
            </div>
        </form>
    </div>
@endsection

@vite(['resources/js/auth/step-navigation.js', 'resources/js/auth/photo-upload.js'])
