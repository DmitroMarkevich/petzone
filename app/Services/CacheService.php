<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public function remember(string $key, Closure $callback, int $ttl = 60): Collection
    {
        return Cache::remember($key, now()->addMinutes($ttl), $callback);
    }

    public function forget(string $key): void
    {
        Cache::forget($key);
    }
}
