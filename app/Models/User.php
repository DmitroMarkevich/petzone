<?php

namespace App\Models;

use App\Models\Advert\Advert;
use App\Models\Order\Order;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'password',
        'image_path',
        'provider_id',
        'provider'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_id',
        'provider'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the wishlist for the user.
     */
    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Advert::class, 'wishlists');
    }

    /**
     * Get the advert for the user.
     */
    public function adverts(): HasMany
    {
        return $this->hasMany(Advert::class, 'owner_id');
    }

    /**
     * Get the orders for the user.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    /**
     * Get the orders for the user.
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Order::class, 'seller_id');
    }

    /**
     * Get the delivery address for the user.
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
