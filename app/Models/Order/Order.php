<?php

namespace App\Models\Order;

use App\Models\User;
use App\Enum\OrderStatus;
use App\Enum\DeliveryMethod;
use App\Models\Advert\Advert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'status',
        'order_number',
        'is_active',

        'buyer_id',
        'seller_id',
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
        'delivery_method' => DeliveryMethod::class,
    ];

    /**
     * Get the advert that is associated with the order.
     */
    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }

    /**
     * Get the seller that owns the order.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Get the buyer that owns the order.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * This is the person who will receive the order.
     */
    public function recipient(): HasOne
    {
        return $this->hasOne(OrderRecipient::class, 'order_id');
    }
}
