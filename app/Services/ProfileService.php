<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use App\Traits\FileUploadTrait;
use App\Models\Address;

class ProfileService
{
    use FileUploadTrait;

    /**
     * Updates the user profile and delivery address.
     *
     * @param object $user The user whose profile and address will be updated.
     * @param array $data Data for updating the user's profile and delivery address.
     * @return void
     */
    public function updateProfile(object $user, array $data): void
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
     * Upload a user's profile logo.
     *
     * @param $user object
     * @param UploadedFile $file
     * @return string Path to the uploaded file
     */
    public function updateAvatar(object $user, UploadedFile $file): string
    {
        $directory = "users/$user->id";

        $imagePath = $this->uploadFile($directory, $file);

        if ($imagePath) {
            $this->deleteAvatar($user);
            $user->update(['image_path' => $imagePath]);
        }

        return $imagePath;
    }

    /**
     * Removes the user's logo.
     *
     * @param object $user The user whose logo will be removed.
     * @return void
     */
    public function deleteAvatar(object $user): void
    {
        if (!$user->image_path) {
            return;
        }

        $this->deleteFile($user->image_path);
        $user->forceFill(['image_path' => null])->save();
    }
}
