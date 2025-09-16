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
     * @param string $key Unique cache key.
     * @param Closure $callback Callback function that will be executed if the cache is empty.
     * @param int $ttl TTL in minutes for which the item should remain in cache.
     */
    public function remember(string $key, Closure $callback, int $ttl = 60): Collection
    {
        return Cache::remember($key, now()->addMinutes($ttl), $callback);
    }
}
