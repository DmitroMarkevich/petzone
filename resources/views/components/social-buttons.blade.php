<div class="social-buttons">
    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="button google">
        <img src="{{ asset('images/auth/google.svg') }}" alt="Google Icon" class="social-icon">
        {{ __('auth.google_login') }}
    </a>

    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="button facebook">
        <img src="{{ asset('images/auth/facebook.svg') }}" alt="Facebook Icon" class="social-icon">
        {{ __('auth.facebook_login') }}
    </a>
</div>
