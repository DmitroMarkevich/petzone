@extends('layouts.auth')

@section('title', 'Зареєструватися')

@section('auth-content')
    <div class="auth-content" x-data="registrationForm()" x-init="init()">
        <div class="auth-header">
            <h2 class="auth-heading">{{ __('auth.register.heading') }}</h2>
            <p class="auth-subheading">{{ __('auth.register.subheading') }}</p>
        </div>

        <form id="registration-form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="step" x-show="step === 1" x-cloak>
                <div class="form-group">
                    <x-form.input type="email" name="email" x-ref="email"
                                  label="{{ __('auth.register.email') }}" placeholder="Email"
                                  data-validation="email"
                                  @input="validateStepOne()"/>

                    <x-form.input type="password" name="password" x-ref="password"
                                  label="{{ __('auth.register.password') }}" placeholder="********"
                                  data-validation="password"
                                  @input="validateStepOne()"/>

                    <x-form.input type="password" name="password_confirmation" x-ref="passwordConfirmation"
                                  label="{{ __('auth.register.password_confirmation') }}" placeholder="********"
                                  data-validation="password"
                                  @input="validateStepOne()"/>
                </div>

                <div>
                    <button type="button" class="button next-step" @click="nextStep()">
                        {{ __('auth.register.next') }}
                    </button>
                    @include('components.partials.social-buttons')
                </div>

                <div class="auth-link">
                    <p>{{ __('auth.register.login_text') }}
                        <a href="{{ route('login') }}">{{ __('auth.register.login_link') }}</a>
                    </p>
                </div>
            </div>

            <div class="step" x-show="step === 2" x-cloak>
                <div class="photo-upload" @click="triggerFileInput">
                    <div class="photo-background" :style="photoStyle">
                        <img x-show="!hasFile" src="{{ asset('images/auth/upload-photo.svg') }}" alt="Upload photo">
                    </div>
                    <input id="profile-photo" type="file" name="logo" accept=".jpeg,.png,.jpg,.svg" hidden @change="fileChanged">
                </div>

                <div class="form-group">
                    <x-form.input type="text" name="first_name" label="{{ __('auth.register.first_name') }}"
                                  placeholder="{{ __('auth.register.first_name_placeholder') }}"/>

                    <x-form.input type="text" name="last_name" label="{{ __('auth.register.last_name') }}"
                                  placeholder="{{ __('auth.register.last_name_placeholder') }}"/>

                    <x-form.input type="tel" name="phone_number" label="{{ __('auth.register.phone_number') }}"
                                  placeholder="{{ __('auth.register.phone_number_placeholder') }}"/>
                </div>

                <button type="submit" class="button submit">{{ __('auth.register.confirm_button') }}</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        function registrationForm() {
            return {
                step: 1,
                hasFile: false,
                photoStyle: '',

                nextStep() {
                    if (this.validateStepOne()) {
                        this.step = 2;
                    } else {
                        console.log('Validation failed');
                    }
                },

                validateStepOne() {
                    let isValid = true;

                    const emailInput = this.$refs.email;
                    const passwordInput = this.$refs.password;
                    const confirmInput = this.$refs.passwordConfirmation;

                    if (!emailInput || !passwordInput || !confirmInput) {
                        console.error('One or more input refs not found');
                        return false;
                    }

                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    const emailValid = emailRegex.test(emailInput.value.trim());
                    this.toggleValidityClass(emailInput, emailValid);
                    if (!emailValid) isValid = false;

                    const passwordValid = passwordInput.value.trim().length >= 8;
                    this.toggleValidityClass(passwordInput, passwordValid);
                    if (!passwordValid) isValid = false;

                    const passwordsMatch = passwordInput.value.trim() === confirmInput.value.trim() && passwordValid;
                    this.toggleValidityClass(confirmInput, passwordsMatch);
                    this.toggleValidityClass(passwordInput, passwordsMatch && passwordValid);

                    if (!passwordsMatch) isValid = false;

                    return isValid;
                },

                toggleValidityClass(el, valid) {
                    if (valid) {
                        el.classList.remove('invalid');
                        el.classList.add('valid');
                    } else {
                        el.classList.remove('valid');
                        el.classList.add('invalid');
                    }
                },

                triggerFileInput() {
                    this.$el.querySelector('#profile-photo')?.click();
                },

                fileChanged(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();

                    reader.onload = ({ target }) => {
                        this.photoStyle = `background-image: url(${target.result}); background-size: cover; background-position: center;`;
                        this.hasFile = true;
                    };

                    reader.readAsDataURL(file);
                }
            };
        }
    </script>
@endpush
