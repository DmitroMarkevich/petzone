@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">{{ __('auth.login.heading') }}</h2>
            <p class="auth-subheading">{{ __('auth.login.subheading') }}</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <x-input type="email" name="email" label="{{ __('auth.login.email') }}" placeholder="Email" autofocus/>
                @error('email')
                <span class="error-message">*{{ $message }}</span>
                @enderror

                <x-input type="password" name="password" label="{{ __('auth.login.password') }}" placeholder="********"/>
                @error('password')
                <span class="error-message">*{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="remember-text">{{ __('auth.login.remember') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">{{ __('auth.login.forgot_password') }}</a>
                @endif
            </div>

            <div class="auth-buttons">
                <button type="submit" class="button login">{{ __('auth.login.login_button') }}</button>
                @include('components.social-buttons')
            </div>
        </form>

        <div class="auth-link">
            <p>{{ __('auth.login.register_text') }}
                <a href="{{ route('register') }}">{{ __('auth.login.register_link') }}</a>
            </p>
        </div>
    </div>
@endsection

<style>
    .error-message {
        display: block;
        color: #FE3535;
        font-size: 12px;
        font-family: 'Inter', sans-serif;
    }
</style>
