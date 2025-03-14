@extends('layouts.profile')

@section('profile-content')
    <div>
        @if($orders->isEmpty())
            <div class="no-adverts">
                <p>No orders found.</p>
            </div>
        @else
            <h2 class="page-title">Ваші замовлення</h2>
            <x-orders-table :orders="$orders" />
        @endif
    </div>
@endsection
