@extends('layouts.profile')

@section('profile-content')
    <div class="page-container">
        @if($wishlist->isEmpty())
            <p>No products found.</p>
        @else
            <div class="advert-grid">
                @foreach($wishlist as $advert)
                    @include('components.advert-card', ['wishlist' => $advert])
                @endforeach
            </div>
        @endif
    </div>
@endsection
