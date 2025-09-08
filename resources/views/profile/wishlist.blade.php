@extends('layouts.profile')

@section('title', 'Вподобання')

@section('profile-content')
    @if($wishlist->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div style="padding-left: 80px">
            <div class="form-row" style="margin-bottom: 30px;">
                <p>Всього ~{{ $wishlist->total() }} результатів</p>

                <x-ui.sort-options :options="['' => 'За релевантністю',
                        'price-asc' => 'Від дешевих до дорогих',
                        'price-desc' => 'Від дорогих до дешевих',
                        'date-asc' => 'Новинки'
                    ]" :selected="request('sort')"
                />
            </div>

            <div class="wishlist-container">
                @foreach($wishlist as $advert)
                    <x-advert-card :advert="$advert"/>
                @endforeach
            </div>

            @if($wishlist->hasPages())
                {{ $wishlist->links() }}
            @endif
        </div>
    @endif
@endsection
