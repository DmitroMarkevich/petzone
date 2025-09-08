@props(['orders', 'short' => false])

<div class="orders-container {{ $short ? 'orders-container--short' : '' }}">
    <div class="orders-header">
        <span>Номер замовлення</span>
        <span>Дата і час</span>
        <span>Статус відправлення</span>
        <span>Номер відстеження</span>
        <span>Ціна</span>
        @unless($short)
            <span>Більше</span>
        @endunless
    </div>

    @foreach ($orders as $order)
        <div class="order-row">
            <span>{{ $order->order_number }}</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
            <div class="status {{ strtolower($order->status->value) }}">
                {{ App\Enum\OrderStatus::getTranslation($order->status) }}
            </div>
            <span>{{ $order->tracking_number ?? '—' }}</span>
            <span>₴{{ $order->total_price ?? '—' }}</span>
            @unless($short)
                <a href="{{ route('profile.orders.show', $order->id) }}">Подивитися</a>
            @endunless
        </div>
    @endforeach
</div>
