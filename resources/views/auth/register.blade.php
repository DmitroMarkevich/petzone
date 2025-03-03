@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">Створіть обліковий запис</h2>
            <p class="auth-subheading">Заповніть дані або оберіть метод:</p>
        </div>

        <!-- Step 1 -->
        <form id="registration-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="step step-1 active">
                <div class="form-group">
                    <x-input type="email" name="email" label="Електронна пошта" placeholder="Email"/>
                    <x-input type="password" name="password" label="Пароль" placeholder="********"/>
                    <x-input type="password" name="password_confirmation" label="Повторіть пароль"
                             placeholder="********"/>
                </div>

                <div class="auth-buttons">
                    <button type="button" class="button next-step">{{ __('Далі') }}</button>
                    @include('components.social-buttons')
                </div>

                <div class="auth-link">
                    <p>{{ __('Вже маєте обліковий запис?') }}
                        <a href="{{ route('login') }}">{{ __('Увійдіть тут') }}</a></p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step step-2">
                <div class="photo-upload">
                    <div class="photo-background" onclick="document.getElementById('profile-photo').click();">
                        <img id="preview-image" src="{{ asset('images/auth/upload-photo.svg') }}"
                             alt="Завантажити фото">
                    </div>
                    <input id="profile-photo" type="file" name="profile_photo" accept="image/*" hidden>
                </div>

                <div class="form-group">
                    <x-input type="text" name="first_name" label="Ім'я" placeholder="Введіть ім’я"/>
                    <x-input type="text" name="last_name" label="Прізвище" placeholder="Введіть прізвище"/>
                    <x-input type="tel" name="phone_number" label="Номер телефону" placeholder="Введіть номер"/>
                </div>

                <button type="submit" class="button register">Підтвердити</button>
            </div>
        </form>
    </div>
@endsection

<script>
    $(document).ready(function () {
        $(".next-step").on("click", function () {
            $(".step-1").removeClass("active");
            $(".step-2").addClass("active");
        });

        $("#profile-photo").on("change", function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $(".photo-background").css({
                        "background-image": `url(${e.target.result})`,
                        "background-position": "center",
                        "background-size": "cover"
                    });
                    $("#preview-image").hide();
                };
                reader.readAsDataURL(file);
            }
        });

        $(".toggle-visibility").on("click", function () {
            let input = $(this).prev("input");
            let icon = $(this).find("img");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.attr("src", "{{ asset('images/auth/eye-open.svg') }}");
            } else {
                input.attr("type", "password");
                icon.attr("src", "{{ asset('images/auth/eye-closed.svg') }}");
            }
        });
    });
</script>
