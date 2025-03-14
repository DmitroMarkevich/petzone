<?php

namespace App\Models;

use App\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'total_price',
        'tracking_number',
        'order_number',
        'is_active',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];
}
