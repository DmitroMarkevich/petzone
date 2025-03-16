<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Upload a file to the storage.
     *
     * @param string $directory The directory where the file should be uploaded.
     * @return string Path to the uploaded file.
     */
    public function uploadFile(string $directory, $file): string
    {
        return Storage::disk('s3')->put($directory, $file, 'public');
    }

    /**
     * Upload a file from a URL.
     *
     * @param string $directory The directory where the file should be uploaded.
     * @param string $url The URL of the file.
     * @return string|null Path to the uploaded file or null if the URL is invalid.
     */
    public function uploadFileFromUrl(string $directory, string $url): ?string
    {
        $response = Http::get($url);

        if ($response->failed()) {
            return null;
        }

        $fileExtension = $this->getFileExtension($url);
        $fileName = uniqid() . '.' . $fileExtension;

        $filePath = "$directory/$fileName";
        $this->uploadFile($filePath, $response->body());

        return $filePath;
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

    /**
     * Get the file extension based on the URL.
     *
     * @param string $url
     * @return string
     */
    private function getFileExtension(string $url): string
    {
        return pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    }
}
