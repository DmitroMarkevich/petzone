<?php

use App\Services\ImageService;

/**
 * Returns "active" if the current route matches the given pattern.
 */
function is_active(string $route): string
{
    return request()->is($route) ? 'active' : '';
}

/**
 * Returns the full URL to an image, or a default if missing.
 */
function image_url(?string $path, ?string $default = null): string
{
    return app(ImageService::class)->getImageUrl($path, $default);
}
