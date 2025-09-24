<?php

namespace App\Services\Profile;

use App\DTO\AddressData;
use App\Models\User;
use App\DTO\ProfileData;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;

class ProfileService
{
    use FileUploadTrait;

    public function updateProfile(User $user, ProfileData $dto): void
    {
        $user->update($dto->toArray());
    }

    public function updateAddress(User $user, AddressData $dto): void
    {
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            $dto->toArray()
        );
    }

    public function updateAvatar(User $user, UploadedFile $file): string
    {
        $imagePath = $this->uploadFile("users/$user->id", $file);

        if ($imagePath) {
            $this->deleteAvatar($user);
            $user->update(['image_path' => $imagePath]);
        }

        return $imagePath;
    }

    public function deleteAvatar(User $user): bool
    {
        if (!$user->image_path) {
            return false;
        }

        $this->deleteFile($user->image_path);
        $user->forceFill(['image_path' => null])->save();

        return true;
    }
}
