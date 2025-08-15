<?php

namespace App\Services\Profile;

use App\Models\User;
use App\Models\Address;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    use FileUploadTrait;

    /**
     * Updates the user profile and delivery address.
     *
     * @param User $user The user to update.
     * @param array $data Data for updating the profile and address.
     * @return void
     */
    public function updateProfile(User $user, array $data): void
    {
        $userData = array_intersect_key($data, array_flip($user->getFillable()));
        if ($userData) {
            $user->update($userData);
        }

        $addressData = array_intersect_key($data, array_flip((new Address())->getFillable()));
        if ($addressData) {
            $user->address()->updateOrCreate(['user_id' => $user->id], $addressData);
        }
    }

    /**
     * Upload and update the user's avatar.
     *
     * @param User $user The user whose avatar will be updated.
     * @param UploadedFile $file The uploaded file.
     * @return string Path to the uploaded file
     */
    public function updateAvatar(User $user, UploadedFile $file): string
    {
        $imagePath = $this->uploadFile("users/$user->id", $file);

        if ($imagePath) {
            $this->deleteAvatar($user);
            $user->update(['image_path' => $imagePath]);
        }

        return $imagePath;
    }

    /**
     * Delete the user's avatar.
     *
     * @param User $user The user whose logo will be removed.
     * @return void
     */
    public function deleteAvatar(User $user): void
    {
        if (!$user->image_path) {
            return;
        }

        $this->deleteFile($user->image_path);
        $user->forceFill(['image_path' => null])->save();
    }
}
