@extends('layouts.profile')

@section('profile-content')
    @if($wishlist->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="advert-grid">
            @foreach($wishlist as $advert)
                @include('components.advert-card', ['wishlist' => $advert])
            @endforeach
        </div>
    @endif
@endsection
