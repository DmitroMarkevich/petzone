<div class="social-buttons">
    <a href="{{ route('social.login', ['provider' => 'google']) }}" class="button google">
        <img src="{{ asset('images/auth/google.svg') }}" alt="Google Icon" class="social-icon">
        Увійти через Google
    </a>

    <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="button facebook">
        <img src="{{ asset('images/auth/facebook.svg') }}" alt="Facebook Icon" class="social-icon">
        Увійти через Facebook
    </a>
</div>
