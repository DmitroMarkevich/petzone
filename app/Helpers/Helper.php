<?php

use App\Services\ImageService;

/**
 * Check if the current route matches the given pattern and return "active" class.
 *
 * @param string $route The route or pattern to check.
 * @return string "active" if the current route matches, otherwise an empty string.
 */
function is_active(string $route): string
{
    return request()->is($route) ? 'active' : '';
}

/**
 * Generate a full URL for an image using the ImageService.
 *
 * This helper function resolves the given image path to a full URL.
 *
 * @param string|null $path The relative path to the image (from storage or DB).
 * @param string|null $default Path to the image if the main image doesn't exist.
 * @return string The URL to the image.
 */
function image_url(?string $path, ?string $default = null): string
{
    return app(ImageService::class)->getImageUrl($path, $default);
}
