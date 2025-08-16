<?php

namespace App\Models\Advert;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
    ];

    /**
     * Get all adverts (products) that belong to this category.
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Advert::class);
    }

    /**
     * Get the parent category of this category.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get all child categories of this category.
     *
     * @return HasMany
     */
    public function children():HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
