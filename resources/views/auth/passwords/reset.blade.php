@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">Введіть новий пароль</h2>
            <p class="auth-subheading">Використовуйте комбінацію літер і цифр:</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                <x-input type="password" name="password"
                         label="{{ __('auth.login.password') }}" placeholder="********"
                         data-validation="password"/>

                <x-input type="password" name="password_confirmation"
                         label="{{ __('auth.register.password_confirmation') }}" placeholder="********"
                         data-validation="password"/>
            </div>

            <button type="submit" class="button submit">Підтвердити</button>
        </form>
    </div>
@endsection
