<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Traits\FileUploadTrait;

class OAuth2Service
{
    use FileUploadTrait;

    /**
     * Handle OAuth user registration or login.
     *
     * @param string $provider The OAuth provider ("google", "facebook" ...).
     * @param mixed $socialUser The social user object returned by the provider.
     * @return User The authenticated or newly created user.
     */
    public function handleOAuthUser(string $provider, mixed $socialUser): User
    {
        $user = User::where('provider_id', $socialUser->getId())
            ->where('provider', $provider)
            ->first();

        if (!$user) {
            [$firstName, $lastName] = $this->extractName($provider, $socialUser);

            $user = app(UserService::class)->create([
                'email' => $socialUser->getEmail(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar_url' => $socialUser->getAvatar(),
            ]);
        }

        return $user;
    }

    /**
     * Extract the user's first and last name based on the provider.
     *
     * @param string $provider The OAuth provider.
     * @param mixed $socialUser The social user object returned by the provider.
     * @return array An array containing [first_name, last_name].
     */
    protected function extractName(string $provider, mixed $socialUser): array
    {
        if ($provider === 'google') {
            $nameParts = explode(' ', $socialUser->getName(), 2);
            return [$nameParts[0] ?? '', $nameParts[1] ?? ''];
        }

        if ($provider === 'facebook') {
            return [
                $socialUser->getUser()['first_name'] ?? '',
                $socialUser->getUser()['last_name'] ?? ''
            ];
        }

        return ['', ''];
    }
}
