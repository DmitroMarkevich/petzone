@extends('layouts.profile')

@section('profile-content')
    @if($orders->isEmpty())
        <div class="no-adverts">
            <p>{{ __('No adverts found.') }}</p>
        </div>
    @else
        <div>
            <h2 class="page-title">Історія замовлень</h2>
            <x-orders-table :orders="$orders" :short="true"/>
        </div>
    @endif
@endsection
