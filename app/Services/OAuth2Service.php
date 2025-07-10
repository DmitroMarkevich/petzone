<?php

namespace App\Services;

use App\Models\User;
use App\Traits\FileUploadTrait;

class OAuth2Service
{
    use FileUploadTrait;

    /**
     * Handle OAuth user registration or login.
     *
     * @param string $provider
     * @param $socialUser
     * @return User
     */
    public function handleOAuthUser(string $provider, $socialUser): User
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
                'provider_id' => $socialUser->getId(),
                'provider' => $provider,
                'avatar_url' => $socialUser->getAvatar(),
            ]);
        }

        return $user;
    }

    /**
     * Extract the user's first and last name based on the provider.
     *
     * @param string $provider
     * @param $socialUser
     * @return array
     */
    protected function extractName(string $provider, $socialUser): array
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
