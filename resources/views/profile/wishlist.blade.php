@extends('layouts.profile')

@section('title', 'Вподобання')

@section('profile-content')
    @if($wishlist->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div>
            @foreach($wishlist as $advert)
                <x-advert-card :advert="$advert" />
            @endforeach
        </div>
    @endif
@endsection
