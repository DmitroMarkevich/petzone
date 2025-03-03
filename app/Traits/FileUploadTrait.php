<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Upload a file to the storage.
     *
     * @param string $directory The directory where the file should be uploaded.
     * @param UploadedFile $file The file to upload.
     * @return string Path to the uploaded file.
     */
    public function uploadFile(string $directory, UploadedFile $file): string
    {
        return Storage::disk('s3')->putFile($directory, $file, 'public');
    }

    /**
     * Delete a file from storage.
     *
     * @param string|null $filePath The path to the file to delete.
     * @return void
     */
    public function deleteFile(?string $filePath): void
    {
        if ($filePath && Storage::disk('s3')->exists($filePath)) {
            Storage::disk('s3')->delete($filePath);
        }
    }
}
