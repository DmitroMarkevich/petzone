<?php

namespace App\Models\Advert;

use App\Models\User;
use App\Models\Wishlist;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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

    /**
     * Get the data to be indexed for search.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
