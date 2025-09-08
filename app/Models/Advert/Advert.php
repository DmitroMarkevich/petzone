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

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * Get all images associated with the advert.
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(AdvertImage::class);
    }

    /**
     * Accessor for the main image of the advert.
     * Returns the path to the first main image, or a default if none exists.
     *
     * @return string
     */
    public function getMainImageAttribute(): string
    {
        return Cache::remember("advert_main_image:$this->id", 60, function () {
            return image_url($this->images->first()?->image_path, 'images/default.png');
        });
    }

    /**
     * Scope to eager load only the main image of the advert.
     *
     * Usage: Advert::withMainImage()->get();
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeWithMainImage(Builder $query): Builder
    {
        return $query->with(['images' => fn($q) => $q->where('main_image', true)]);
    }

    /**
     * Get the category associated with the advert.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who created the advert.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get all wishlist entries that include this advert.
     *
     * @return HasMany
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'advert_id');
    }

    /**
     * Determines whether the advert should display a discount price.
     *
     * Returns true if there is a previous price greater than the current price
     * and the price change occurred within the last 3 weeks.
     *
     * @return bool
     */
    public function shouldShowDiscountPrice(): bool
    {
        if (!$this->previous_price || $this->price >= $this->previous_price) {
            return false;
        }

        return Carbon::parse($this->price_changed_at)->gt(now()->subWeeks(3));
    }

    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' => $this->price,
        ];
    }
}
