<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use App\Services\OAuth2Service;
use App\Http\Controllers\Controller;

class OAuth2Controller extends Controller
{
    protected OAuth2Service $oauthService;

    public function __construct(OAuth2Service $oauthService)
    {
        $this->oauthService = $oauthService;
    }

    /**
     * Redirect the user to the OAuth provider.
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle OAuth provider callback and authenticate the user.
     */
    public function handleProviderCallback(string $provider): RedirectResponseAlias
    {
        $socialUser = Socialite::driver($provider)->user();
        $user = $this->oauthService->handleOAuthUser($provider, $socialUser);
        auth()->login($user);

        return redirect()->route('home');
    }
}
