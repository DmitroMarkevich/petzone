@extends('layouts.profile')

@section('title', 'Ваші замовлення')

@section('profile-content')
    @if($orders->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div>
            <h2 class="page-title">Ваші замовлення</h2>
            <x-order.table :orders="$orders->getCollection()"/>

            @if($orders->hasPages())
                {{ $orders->links() }}
            @endif
        </div>
    @endif
@endsection
