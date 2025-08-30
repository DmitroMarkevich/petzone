<?php

namespace App\Models\Advert;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advert extends Model
{
    use HasFactory, HasUuids;

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
        'random_seed',
        'category_id',
        'owner_id'
    ];

    /**
     * Boot method for the model.
     *
     * Automatically sets a random seed when creating a new advert.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($advert) {
            // Set a random number between 0 and 1 for random order
            $advert->random_seed = mt_rand() / mt_getrandmax();
        });
    }

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
        return image_url($this->images->first()?->image_path, 'images/default.png');
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

    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'advert_id');
    }

    public function shouldShowDiscountPrice(): bool
    {
        if (!$this->previous_price || $this->price >= $this->previous_price || !$this->price_changed_at) {
            return false;
        }

        return Carbon::parse($this->price_changed_at)->gt(now()->subWeeks(3));
    }
}
