<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Traits\FileUploadTrait;
use App\Models\User;

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
            $id = Str::uuid();
            $avatarPath = $this->handleAvatar($socialUser, $id);
            [$firstName, $lastName] = $this->extractName($provider, $socialUser);

            $user = User::create([
                'id' => $id,
                'email' => $socialUser->getEmail(),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'image_path' => $avatarPath,
                'provider_id' => $socialUser->getId(),
                'provider' => $provider,
                'password' => bcrypt(Str::random(32)),
            ]);
        }

        return $user;
    }

    /**
     * Handle avatar upload and return the file path.
     *
     * @param $socialUser
     * @param string $id
     * @return string|null
     */
    protected function handleAvatar($socialUser, string $id): ?string
    {
        $avatarUrl = $socialUser->getAvatar();
        if (!$avatarUrl) {
            return null;
        }

        $directory = "users/$id";

        return $this->uploadFileFromUrl($directory, $avatarUrl);
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
