<?php

namespace App\Models\Advert;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Wishlist;
use App\Enum\Advert\AdvertSortOption;
use App\Enum\Advert\AdvertFilterOption;
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
     * Get the category associated with the advert.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who created the advert.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get all wishlist entries that include this advert.
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'advert_id');
    }

    /**
     * Determines whether the advert should display a discount price.
     * Returns true if there is a previous price greater than the current price
     * and the price change occurred within the last 3 weeks.
     */
    public function shouldShowDiscountPrice(): bool
    {
        if (!$this->previous_price || $this->price >= $this->previous_price) {
            return false;
        }

        return Carbon::parse($this->price_changed_at)->gt(now()->subWeeks(3));
    }

    /**
     * Accessor for the main image of the advert.
     * Returns the path to the first main image, or a default if none exists.
     */
    public function getMainImageAttribute(): string
    {
        return Cache::remember("advert_main_image:$this->id", 60, function () {
            return image_url($this->images->first()?->image_path, 'images/advert/default.png');
        });
    }

    /**
     * Scope to eager load only the main image of the advert.
     * Usage: Advert::withMainImage()->get();
     */
    public function scopeWithMainImage(Builder $query): Builder
    {
        return $query->with(['images' => fn($q) => $q->where('main_image', true)]);
    }

    public function scopeFilterQuery(Builder $query, ?string $search): Builder
    {
        if (!$search) return $query;

        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
        });
    }

    public function scopeFilterCategory(Builder $query, ?string $slug): Builder
    {
        if (!$slug) return $query;

        $category = Category::where('slug', $slug)->first();

        if (!$category) return $query;

        $ids = $category->children()->exists()
            ? $category->children()->pluck('id')->push($category->id)
            : [$category->id];

        return $query->whereIn('category_id', $ids);
    }

    public function scopeFilterSort(Builder $query, ?string $sort, ?string $search = null, ?string $category = null): Builder
    {
        $sortOption = AdvertSortOption::tryFromRequest($sort);

        if ($sortOption) {
            return $sortOption->apply($query);
        }

        if (!$search && !$category) {
            return $query->inRandomOrder();
        }

        return $query;
    }

    public function scopeFilter(Builder $query, ?string $filter): Builder
    {
        $filterOption = AdvertFilterOption::tryFromRequest($filter);

        return $filterOption ? $filterOption->apply($query) : $query;
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
