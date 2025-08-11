<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    use FileUploadTrait;

    /**
     * Create a new user with provided data.
     *
     * Handles uploading logo or avatar from URL, normalizes phone number,
     * and sets default values where necessary.
     *
     * @param array $data Array of user data.
     * @return User Newly created User model instance.
     */
    public function create(array $data): User
    {
        $id = Str::uuid();
        $imagePath = null;

        if (isset($data['logo'])) {
            $imagePath = $this->uploadFile("users/$id", $data['logo']);
        }

        if (isset($data['avatar_url'])) {
            $imagePath = $this->uploadFileFromUrl("users/$id", $data['avatar_url']);
        }

        $normalizedPhone = $this->normalizePhoneNumber($data['phone_number'] ?? null);

        return User::create([
            'id' => $id,
            'email' => $data['email'],
            'first_name' => $data['first_name'] ?? '',
            'last_name' => $data['last_name'] ?? '',
            'phone_number' => $normalizedPhone,
            'image_path' => $imagePath,
            'provider_id' => $data['provider_id'] ?? null,
            'provider' => $data['provider'] ?? 'local',
            'password' => $data['password'] ?? Hash::make(Str::random(32)),
            'ip_address' => $data['ip_address'] ?? request()->ip(),
        ]);
    }

    /**
     * Normalize phone number by removing non-digit characters.
     *
     * @param string|null $phone
     * @return string|null Digits only or null.
     */
    private function normalizePhoneNumber(?string $phone): ?string
    {
        if (!$phone) {
            return null;
        }

        return preg_replace('/\D+/', '', $phone);
    }
}
