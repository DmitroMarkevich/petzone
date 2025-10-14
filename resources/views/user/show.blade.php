@extends('layouts.app')

@section('app-content')
    <div class="container">
        <div class="seller-profile">
            <div class="profile-header">
                <img src="{{ image_url($user->image_path, 'images/default-avatar.png') }}"
                     class="seller-avatar" alt="Seller Avatar">

                <div class="profile-info">
                    <h2 class="profile-name">{{ $user->first_name }} {{ $user->last_name }}</h2>

                    <div class="profile-meta">
                        <p>Приєднався {{ $user->created_at->format('d.m.Y') }} р.</p>

                        <!-- todo -->
                        <span>Онлайн 07.10.2025 р.</span>
                    </div>

                    <button class="share-btn" onclick="shareProfile()">Поширити</button>
                </div>
            </div>

            <hr class="section-divider">

            <section class="adverts-section">
                <h3>Оголошення продавця</h3>

                <div class="form-row">
                    <p class="total-count">Всього ~{{ $adverts->total() }} оголошень</p>

                    <div class="controls">
                        <x-ui.sort-options :options="[
                            'relevance' => 'За релевантністю',
                            'price-asc' => 'Від дешевих до дорогих',
                            'price-desc'=> 'Від дорогих до дешевих',
                            'date-asc'  => 'Новинки'
                        ]" :selected="request('sort') ?? 'relevance'"/>

                        <div class="view-toggle">
                            <button><img src="{{ asset('images/advert/grid.svg') }}"></button>
                            <button><img src="{{ asset('images/advert/list.svg') }}"></button>
                        </div>
                    </div>
                </div>

                <div class="adverts-section-content">
                    <div class="search-container">
                        <input type="text" placeholder="Пошук оголошень..." class="search-input">
                        <button type="submit" aria-label="Search" class="search-button">
                            <img src="{{ asset('images/header/search.svg') }}" alt="Search">
                        </button>
                    </div>

                    <div class="adverts-grid">
                        @forelse($adverts as $advert)
                            <x-advert-card :advert="$advert" small="true"/>
                        @empty
                            <p class="no-adverts">Оголошень поки немає.</p>
                        @endforelse
                    </div>
                </div>

                @if($adverts->hasPages())
                    <div class="pagination-wrapper">
                        {{ $adverts->appends(request()->except('page'))->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection

<script>
    function shareProfile() {
        const url = '{{ url()->current() }}';
        if (navigator.share) {
            navigator.share({url});
        } else {
            navigator.clipboard.writeText(url);
        }
    }
</script>

