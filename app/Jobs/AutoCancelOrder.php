<?php

namespace App\Jobs;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Order;
use App\Enum\OrderStatus;

class AutoCancelOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $orderId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order = Order::find($this->orderId);

        if (!$order || $order->accepted_at || $order->status !== OrderStatus::PENDING) {
            return;
        }

        $order->update([
            'canceled_at' => now(),
            'cancellation_reason' => 'seller_not_confirmed',
            'status' => OrderStatus::CANCELED,
        ]);
    }
}
