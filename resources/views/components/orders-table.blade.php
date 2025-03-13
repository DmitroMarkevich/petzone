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
            <span>{{ $order->id }}</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
            <div class="status waiting">{{ $order->status }}</div>
            <span>{{ $order->tracking_number ?? '—' }}</span>
            <span>€{{ $order->price }}</span>
            @unless($short)
                <a href="#">Подивитися</a>
            @endunless
        </div>
    @endforeach
</div>
