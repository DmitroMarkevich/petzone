<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;

trait FileUploadTrait
{
    /**
     * Get the default disk name to be used for storage.
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

    public function uploadFile(string $directory, $file): string
    {
        return $this->disk()->put($directory, $file, 'public');
    }

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

    public function deleteFile(?string $filePath): void
    {
        if ($filePath && $this->disk()->exists($filePath)) {
            $this->disk()->delete($filePath);
        }
    }

    private function getFileExtension(string $url): string
    {
        return pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
    }
}
