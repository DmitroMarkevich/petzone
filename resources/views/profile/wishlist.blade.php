@extends('layouts.profile')

@section('title', 'Вподобання')

@section('profile-content')
    @if($wishlist->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="wishlist-wrapper">
            <div class="wishlist-header">
                <p>Всього ~{{ $wishlist->total() }} результатів</p>

                <x-ui.sort-options :options="[
                        '' => 'За релевантністю',
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

@push('scripts')
    @vite('resources/js/modules/ui/wishlist.js')
@endpush
