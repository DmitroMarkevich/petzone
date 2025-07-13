@extends('layouts.profile')

@section('profile-content')
    @if($adverts->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="adverts-container">
            <h2 class="page-title">Мої оголошення</h2>

            <div class="filter-buttons">
                <button class="filter-button active">Всі ({{ $adverts->count() }})</button>
                <button class="filter-button" data-status="active">
                    Активні ({{ $adverts->where('is_active', true)->count() }})
                </button>
                <button class="filter-button" data-status="no-active">
                    Неактивні ({{ $adverts->where('is_active', false)->count() }})
                </button>
            </div>

            <div class="adverts-list">
                @foreach($adverts as $advert)
                    <x-advert-item :advert="$advert" :status="$advert->is_active ? 'active' : 'no-active'">
                        <x-slot name="actions">
                            <a href="{{ route('adverts.edit', $advert->id) }}" class="edit-btn">Редагувати</a>

                            <form action="{{ route('adverts.destroy', $advert->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Видалити</button>
                            </form>
                        </x-slot>
                    </x-advert-item>
                @endforeach
            </div>
        </div>
    @endif
@endsection

@vite(['resources/js/profile/filter-buttons.js'])
