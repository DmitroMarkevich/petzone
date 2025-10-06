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
            <form id="filter-form" method="GET" action="{{ route('advert.index') }}">
                @foreach(request()->except(['page', 'price_min', 'price_max', 'category', 'location']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <div class="filters-list">
                    <div class="form-row">
                        <h3>Фільтрувати</h3>
                        <button type="button" class="filter-reset">Очистити все</button>
                    </div>

                    <x-ui.filter-group label="Категорія">
                        <select name="category" class="filter-select">
                            <option value="">Всі категорії</option>
                        </select>
                    </x-ui.filter-group>

                    <x-ui.price-slider :max="$maxPrice"/>

                    <x-ui.filter-group label="Локація">
                        <input type="text" name="location" value="{{ request('location') }}" placeholder="Місто" class="filter-input">
                    </x-ui.filter-group>

                    <button type="submit" class="modal-search-btn">Пошук</button>
                </div>
            </form>

            <div style="width: 100%">
                @if($adverts->isEmpty())
                    <div class="no-results" style="flex: 1; width: 100%">
                        <p>{{ __('common.nothing_found') }}</p>
                    </div>
                @else
                    <div class="results-section">
                        <div class="form-row">
                            <p>Всього ~{{ $adverts->total() }} результатів</p>
                            <x-ui.sort-options :options="[
                                'relevance' => 'За релевантністю',
                                'price-asc' => 'Від дешевих до дорогих',
                                'price-desc'=> 'Від дорогих до дешевих',
                                'date-asc'  => 'Новинки'
                            ]" :selected="request('sort') ?? 'relevance'"/>
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
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('filter-form');

            form.addEventListener('submit', () => {
                form.querySelectorAll('input, select').forEach(input => {
                    if (!input.value.trim()) input.removeAttribute('name');
                });
            });

            document.querySelector('.filter-reset').addEventListener('click', () => {
                form.reset();
                form.submit();
            });
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('rangeSlider', ({ min, max, priceMin, priceMax }) => ({
                min, max,
                priceMin, priceMax,
                percentMin: 0,
                percentMax: 100,
                minGap: 100,

                init() {
                    this.updatePercents();
                },

                updatePercents() {
                    const range = this.max - this.min;
                    this.percentMin = Math.max(0, Math.min(100, ((this.priceMin - this.min) / range) * 100));
                    this.percentMax = Math.max(0, Math.min(100, ((this.priceMax - this.min) / range) * 100));
                },

                startDrag(handle, event) {
                    const slider = event.target.closest('.slider-wrapper');

                    const onMove = e => {
                        const rect = slider.getBoundingClientRect();
                        let percent = ((e.clientX - rect.left) / rect.width) * 100;
                        percent = Math.max(0, Math.min(100, percent));
                        const value = this.min + ((this.max - this.min) * percent / 100);

                        if (handle === 'min') {
                            if (value >= this.priceMax - this.minGap) return;
                            this.priceMin = Math.round(value);
                        } else {
                            if (value <= this.priceMin + this.minGap) return;
                            this.priceMax = Math.round(value);
                        }
                        this.updatePercents();
                    };

                    const stopDrag = () => {
                        window.removeEventListener('mousemove', onMove);
                        window.removeEventListener('mouseup', stopDrag);
                    };

                    window.addEventListener('mousemove', onMove);
                    window.addEventListener('mouseup', stopDrag);
                }
            }));
        });
    </script>
@endpush

