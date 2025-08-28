@extends('layouts.app')

@section('title', 'Результати пошуку')

@section('app-content')
    <div class="page-container">
        <div style="margin-top: 40px">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
                </a>
                <span>Dogs / Food / Vitamins</span>
            </div>

            <div style="display: flex; gap: 48px">
                <div style="display: flex; gap: 50px">
                    <div>
                        <div class="form-row">
                            <h3>Фільтрувати</h3>
                            <button style="color: #797677">Очистити все</button>
                        </div>

                        <div class="filters-list">
                            <div class="filter-group">
                                <label for="category">Категорія</label>
                                <select id="category">
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
                                    <input type="number" min="0" placeholder="від" id="price-min">
                                    <input type="number" min="0" placeholder="до" id="price-max">
                                </div>
                                <input type="range" min="0" max="10000" step="10" id="price-range">
                            </div>

                            <div class="filter-group">
                                <label>Локація
                                    <input type="text" placeholder="Місто / Район">
                                </label>
                            </div>

                            <div class="filter-group">
                                <label for="animal-type">Вид тварини</label>
                                <select id="animal-type">
                                    <option>Собаки</option>
                                    <option>Коти</option>
                                    <option>Гризуни</option>
                                    <option>Птахи</option>
                                    <option>Рептилії</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                @if($adverts->isEmpty())
                    <div class="no-results">
                        <p>{{ __('common.nothing_found') }}</p>
                    </div>
                @else
                    <div style="display: flex; flex-direction: column; width: 100%">
                        <div class="form-row" style="margin-bottom: 30px;">
                            <p>Всього ~{{ count($adverts) }} результатів</p>

                            <div class="sort-container">
                                <label for="sort-options"></label>
                                <select id="sort-options" class="sort-options">
                                    <option value="price-asc">Від дешевих до дорогих</option>
                                    <option value="price-desc">Від дорогих до дешевих</option>
                                    <option value="date-asc">Новинки</option>
                                    <option value="date-asc" selected>За рейтингом</option>
                                </select>
                            </div>
                        </div>

                        <div class="advert-grid">
                            @foreach($adverts as $advert)
                                <x-advert-card :advert="$advert"/>
                            @endforeach
                        </div>

                        @if($adverts->hasPages())
                            {{ $adverts->links() }}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

<style>
    .filters-list {
        width: 300px;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    select, input {
        width: 100%;
        padding: 8px;
        border: 1px solid #E6E1E2;
        border-radius: 5px;
        font-size: 14px;
    }

    input[type="checkbox"] {
        width: auto;
        margin-right: 5px;
    }

    .filter-group div {
        display: flex;
        align-items: center;
    }

    .sort-options {
        border: 1px solid #E6E1E2;
    }
</style>
