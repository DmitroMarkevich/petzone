@extends('layouts.profile')

@section('profile-content')
    @if($orders->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div>
            <h2 class="page-title">Ваші замовлення</h2>
            <x-orders-table :orders="$orders"/>
        </div>
    @endif
@endsection
