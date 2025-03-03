@extends('layouts.auth')

@section('auth-content')
    <div class="auth-content">
        <div class="auth-header">
            <h2 class="auth-heading">{{ __('auth.register.heading') }}</h2>
            <p class="auth-subheading">{{ __('auth.register.subheading') }}</p>
        </div>

        <form id="registration-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="step step-1 active">
                <div class="form-group">
                    <x-input type="email" name="email" label="{{ __('auth.register.email') }}" placeholder="Email"/>
                    <x-input type="password" name="password" label="{{ __('auth.register.password') }}" placeholder="********"/>
                    <x-input type="password" name="password_confirmation" label="{{ __('auth.register.password_confirmation') }}" placeholder="********"/>
                </div>

                <div class="auth-buttons">
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
                    <div class="photo-background" onclick="document.getElementById('profile-photo').click();">
                        <img id="preview-image" src="{{ asset('images/auth/upload-photo.svg') }}" alt="Завантажити фото">
                    </div>
                    <input id="profile-photo" type="file" name="profile_photo" accept="image/*" hidden>
                </div>

                <div class="form-group">
                    <x-input type="text" name="first_name" label="{{ __('auth.register.first_name') }}" placeholder="Enter first name"/>
                    <x-input type="text" name="last_name" label="{{ __('auth.register.last_name') }}" placeholder="Enter last name"/>
                    <x-input type="tel" name="phone_number" label="{{ __('auth.register.phone_number') }}" placeholder="Enter phone number"/>
                </div>

                <button type="submit" class="button register">{{ __('auth.register.confirm_button') }}</button>
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
