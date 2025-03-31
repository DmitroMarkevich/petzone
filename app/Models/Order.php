<?php

namespace App\Models;

use App\OrderStatus;
use App\DeliveryMethod;
use App\Models\Advert\Advert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'status',
        'tracking_number',
        'delivery_cost',
        'delivery_method',
        'estimated_delivery_date',
        'payment_method',
        'shipped_at',
        'delivered_at',
        'order_number',
        'is_active',
        'accepted_at',
        'canceled_at',
        'cancellation_reason',
        'buyer_id',
        'advert_id',
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
}
