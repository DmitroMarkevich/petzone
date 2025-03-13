@extends('layouts.profile')

@section('profile-content')
    <div class="page-container">
        @if($wishlist->isEmpty())
            <div class="no-adverts">
                <p>No adverts found.</p>
            </div>
        @else
            <div class="advert-grid">
                @foreach($wishlist as $advert)
                    @include('components.advert-card', ['wishlist' => $advert])
                @endforeach
            </div>
        @endif
    </div>
@endsection
