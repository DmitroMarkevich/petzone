<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderRecipient extends Model
{
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',

        'first_name',
        'last_name',
        'middle_name',
        'phone_number',

        'warehouse_ref',
        'warehouse_title',
        'warehouse_settlement_type',
        'warehouse_city',
        'warehouse_region',
    ];

    /**
     * Get the order associated with this recipient.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
