@extends('layouts.profile')

@section('profile-content')
    @if($orders->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div>
            <h2 class="page-title">Історія замовлень</h2>
            <x-orders-table :orders="$orders" :short="true"/>
        </div>
    @endif
@endsection
