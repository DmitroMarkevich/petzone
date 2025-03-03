@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">Вхід в обліковий запис</h2>
            <p class="auth-subheading">З поверненням! Оберіть метод входу:</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <x-input type="email" name="email" label="Електронна пошта" placeholder="Email" autofocus/>
                @error('email')
                    <span class="error-message">*{{ $message }}</span>
                @enderror

                <x-input type="password" name="password" label="Пароль" placeholder="********"/>
                @error('password')
                    <span class="error-message">*{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label>
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="remember-text">{{ __('Запам’ятати мене') }}</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-password">{{ __('Забули пароль?') }}</a>
                @endif
            </div>

            <div class="auth-buttons">
                <button type="submit" class="button login">{{ __('Увійти') }}</button>
                @include('components.social-buttons')
            </div>
        </form>

        <div class="auth-link">
            <p>{{ __('Немає облікового запису?') }}
                <a href="{{ route('register') }}">{{ __('Зареєструватися') }}</a>
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
