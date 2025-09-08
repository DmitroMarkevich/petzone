<?php

namespace App\DTO;

use App\Models\User;
use App\Models\Advert\Advert;
use App\Enum\OrderStatus;
use Spatie\LaravelData\Data;

class OrderData extends Data
{
    public function __construct(
        public string $advert_id,
        public string $payment_method,
        public string $delivery_method,
    ) {}

    public function toModelAttributes(User $buyer, Advert $advert, OrderStatus $status): array
    {
        return [
            'status'          => $status,
            'order_number'    => uniqid(),
            'buyer_id'        => $buyer->id,
            'advert_id'       => $advert->id,
            'seller_id'       => $advert->owner_id,
            'total_price'     => $advert->price,
            'payment_method'  => $this->payment_method,
            'delivery_method' => $this->delivery_method,
        ];
    }
}
