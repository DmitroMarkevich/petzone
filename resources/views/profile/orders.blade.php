@extends('layouts.profile')

@section('profile-content')
    @if($orders->isEmpty())
        <div class="no-adverts">
            <p>No orders found.</p>
        </div>
    @else
        <div>
            <h2 class="page-title">Ваші замовлення</h2>
            <x-orders-table :orders="$orders"/>
        </div>
    @endif
@endsection
