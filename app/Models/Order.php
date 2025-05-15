<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enum\OrderStatus;
use App\Models\Advert\Advert;

class Order extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'order_number',
        'is_active',

        'buyer_id',
        'advert_id',

        'payment_method',

        'delivery_method',
        'tracking_number',
        'delivery_cost',
        'total_price',
        'estimated_delivery_date',

        'accepted_at',
        'shipped_at',
        'delivered_at',
        'canceled_at',
        'cancellation_reason',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    /**
     * Get the advert that is associated with the order.
     */
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
