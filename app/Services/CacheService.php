<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Retrieve an item from cache, or execute callback and store the result.
     *
     * @param string $key The unique cache key to identify the cached value.
     * @param Closure $callback Function to generate value if not cached
     * @param int $minutes Cache duration in minutes
     * @return Collection The cached value as a Collection.
     */
    public function remember(string $key, Closure $callback, int $minutes = 60): Collection
    {
        return Cache::remember($key, now()->addMinutes($minutes), $callback);
    }
}
