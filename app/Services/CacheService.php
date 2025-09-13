<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Retrieve an item from cache, or execute callback and store the result.
     */
    public function remember(string $key, Closure $callback, int $minutes = 60): Collection
    {
        return Cache::remember($key, now()->addMinutes($minutes), $callback);
    }
}
