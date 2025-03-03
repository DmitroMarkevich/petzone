<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class OAuth2Controller extends Controller
{
    /**
     * Redirect the user to the OAuth provider.
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle OAuth provider callback and authenticate the user.
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $firstName = '';
        $lastName = '';

        $avatarPath = null;
        $avatarUrl = $socialUser->getAvatar();

        if ($avatarUrl) {
            $avatarContent = Http::get($avatarUrl)->body();
            $avatarName = 'avatars/' . Str::uuid() . '.jpg';

            Storage::disk('s3')->put($avatarName, $avatarContent);
            $avatarPath = $avatarName;
        }

        if ($provider == 'google') {
            $fullName = $socialUser->getName();
            $nameParts = explode(' ', $fullName, 2);

            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';
        } elseif ($provider == 'facebook') {
            $firstName = $socialUser->getUser()['first_name'];
            $lastName = $socialUser->getUser()['last_name'];
        }

        $user = User::where('provider_id', $socialUser->getId())
            ->where('provider', $provider)
            ->first();

        if (!$user) {
            $user = User::create([
                'email' => $socialUser->getEmail(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'provider_id' => $socialUser->getId(),
                'provider' => $provider,
                'image_path' => $avatarPath,
                'password' => bcrypt(Str::random(32))
            ]);
        }

        auth()->login($user);

        return redirect()->route('home');
    }
}
