@extends('layouts.app')

@section('app-content')
    <div class="page-container">
        @if($adverts->isEmpty())
            <p>No products found.</p>
        @else
            <div class="advert-grid">
                @foreach($adverts as $advert)
                    @include('components.advert-card', ['adverts' => $advert])
                @endforeach
            </div>
        @endif
    </div>
@endsection
