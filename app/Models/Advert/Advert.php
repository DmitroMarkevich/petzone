<?php

namespace App\Models\Advert;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Advert extends Model
{
    use HasFactory, HasUuids, Searchable;

    protected $fillable = [
        'id',
        'title',
        'price',
        'previous_price',
        'description',
        'average_rating',
        'category_id',
        'owner_id'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(AdvertImage::class);
    }

    public function getMainImageAttribute(): string
    {
        return Cache::remember("advert_main_image:$this->id", 60, function () {
            return image_url($this->images->first()?->image_path, 'images/advert/default.png');
        });
    }

    public function scopeWithMainImage(Builder $query): Builder
    {
        return $query->with(['images' => fn($q) => $q->where('main_image', true)]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'advert_id');
    }

    public function shouldShowDiscountPrice(): bool
    {
        if (!$this->previous_price || $this->price >= $this->previous_price) {
            return false;
        }

        return Carbon::parse($this->price_changed_at)->gte(now()->subWeeks(3));
    }

    public function scopeDiscounted(Builder $query): Builder
    {
        return $query->whereNotNull('previous_price')
            ->whereColumn('previous_price', '>', 'price')
            ->where('price_changed_at', '>', now()->subWeeks(3));
    }

    public function scopeFresh(Builder $query, int $hours = 24): Builder
    {
        return $query->where('created_at', '>=', now()->subHours($hours));
    }

    public function toSearchableArray(): array
    {
        return [
            'title'        => $this->title,
            'description'  => $this->description,
            'price'        => (float) $this->price,
            'category_id'  => $this->category_id,
            'created_at'   => $this->created_at?->toDateTimeString(),
            'has_discount' => $this->shouldShowDiscountPrice(),
        ];
    }
}
