@props(['orders', 'short' => false])

@php
    $showDetailsColumn = !$short;
@endphp

<div @class(['orders-container', 'orders-container--short' => $short])>
    <div class="orders-header">
        <span>Номер замовлення</span>
        <span>Дата і час</span>
        <span>Статус відправлення</span>
        <span>Номер відстеження</span>
        <span>Ціна</span>
        @if ($showDetailsColumn)
            <span>Більше</span>
        @endif
    </div>

    @foreach ($orders as $order)
        <div class="order-row">
            <span>{{ $order->order_number }}</span>
            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
            <div class="status {{ strtolower($order->status->value) }}">
                {{ App\OrderStatus::getTranslation($order->status) }}
            </div>
            <span>{{ $order->tracking_number ?: '—' }}</span>
            <span>₴{{ $order->total_price ?? '—' }}</span>
            @if ($showDetailsColumn)
                <a href="#">Подивитися</a>
            @endif
        </div>
    @endforeach
</div>
