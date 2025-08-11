<?php

namespace App\Models;

use App\Models\Advert\Advert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'advert_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }
}
