@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">Відновлення паролю</h2>
            <p class="auth-subheading">
                Введіть свою електронну адресу, щоб отримати посилання для зміни паролю.
            </p>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <x-input type="email" name="email"
                         label="{{ __('auth.login.email') }}" placeholder="********"
                         data-validation="email"/>
            </div>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <button type="submit" class="button submit">Підтвердити</button>

            <div class="auth-link">
                <p>Не прийшов лист? <a href="">Надіслати знову</a></p>
            </div>
        </form>
    </div>
@endsection
