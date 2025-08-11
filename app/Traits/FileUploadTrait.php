<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

trait FileUploadTrait
{
    /**
     * Get the default disk name to be used for storage.
     *
     * @return string The name of the filesystem disk ('public', 's3').
     */
    protected function getDisk(): string
    {
        return config('filesystems.default', 'public');
    }

    /**
     * Get the Filesystem instance for the configured disk.
     *
     * @return Filesystem The filesystem disk instance.
     */
    protected function disk(): Filesystem
    {
        return Storage::disk($this->getDisk());
    }

    /**
     * Upload a file to the storage.
     *
     * @param string $directory The directory where the file should be uploaded.
     * @return string Path to the uploaded file.
     */
    public function uploadFile(string $directory, $file): string
    {
        return $this->disk()->put($directory, $file, 'public');
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
        if ($filePath && $this->disk()->exists($filePath)) {
            $this->disk()->delete($filePath);
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
