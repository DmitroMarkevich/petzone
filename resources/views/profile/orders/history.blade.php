@extends('layouts.profile')

@section('title', 'Історія замовлень')

@section('profile-content')
    @if($orders->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div>
            <h2 class="page-title">Історія замовлень</h2>
            <x-order.table :orders="$orders->getCollection()" :short="true"/>

            @if($orders->hasPages())
                {{ $orders->links() }}
            @endif
        </div>
    @endif
@endsection
