@extends('layouts.profile')

@section('profile-content')
    <div>
        @if($orders->isEmpty())
            <div class="no-adverts">
                <p>No orders found.</p>
            </div>
        @else
            <h2 class="page-title">Історія замовлень</h2>
            <x-orders-table :orders="$orders" :short="true" />
        @endif
    </div>
@endsection
