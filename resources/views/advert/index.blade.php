@extends('layouts.app')

@section('title', 'Результати пошуку')

@section('app-content')
    <div class="page-container search-page">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
            </a>
            <span>Dogs / Food / Vitamins</span>
        </div>

        <div class="search-layout">
            <div>
                <div class="form-row">
                    <h3>Фільтрувати</h3>
                    <button class="filter-reset">Очистити все</button>
                </div>

                <div class="filters-list">
                    <div class="filter-group">
                        <label for="category">Категорія</label>
                        <select id="category" class="filter-select">
                            <option>Грумінг</option>
                            <option>Ветеринар</option>
                            <option>Дресирування</option>
                            <option>Готель для тварин</option>
                            <option>Вигул</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Ціна</label>
                        <div class="form-row">
                            <input type="number" min="0" placeholder="від" id="price-min" class="filter-input">
                            <input type="number" min="0" placeholder="до" id="price-max" class="filter-input">
                        </div>
                        <input type="range" min="0" max="10000" step="10" id="price-range" class="filter-range">
                    </div>

                    <div class="filter-group">
                        <label>Локація
                            <input type="text" placeholder="Місто / Район" class="filter-input">
                        </label>
                    </div>
                </div>
            </div>

            @if($adverts->isEmpty())
                <div class="no-results" style="flex: 1; width: 100%">
                    <p>{{ __('common.nothing_found') }}</p>
                </div>
            @else
                <div style="width: 100%">
                    <div class="results-section">
                        <div class="form-row">
                            <p>Всього ~{{ $adverts->total() }} результатів</p>

                            <x-ui.sort-options :options="[
                                'relevance' => 'За релевантністю',
                                'price-asc' => 'Від дешевих до дорогих',
                                'price-desc'=> 'Від дорогих до дешевих',
                                'date-asc'  => 'Новинки'
                            ]" :selected="request('sort') ?? 'relevance'" />
                        </div>

                        <div class="advert-grid">
                            @foreach($adverts as $advert)
                                <x-advert-card :advert="$advert"/>
                            @endforeach
                        </div>

                        @if($adverts->hasPages())
                            {{ $adverts->appends(request()->except('page'))->links() }}
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
