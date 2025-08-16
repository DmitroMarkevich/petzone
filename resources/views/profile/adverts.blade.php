@extends('layouts.profile')

@section('title', 'Мої оголошення')

@section('profile-content')
    @if($adverts->isEmpty())
        <div class="no-results">
            <p>{{ __('common.nothing_found') }}</p>
        </div>
    @else
        <div class="adverts-container">
            <h2 class="page-title">Мої оголошення</h2>

            <x-filter-buttons :items="$adverts->getCollection()" :filters="[
                ['key' => 'is_active', 'value' => true, 'label' => 'Активні'],
                ['key' => 'is_active', 'value' => false, 'label' => 'Неактивні']
            ]" />

            <div class="adverts-list">
                @foreach($adverts as $advert)
                    <x-advert.item :advert="$advert" :status="$advert->is_active">
                        <x-slot name="actions">
                            <a href="{{ route('adverts.edit', $advert->id) }}" class="edit-btn">Редагувати</a>

                            <form action="{{ route('adverts.destroy', $advert->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Видалити</button>
                            </form>
                        </x-slot>
                    </x-advert.item>
                @endforeach
            </div>

            @if($adverts->hasPages())
                {{ $adverts->links() }}
            @endif
        </div>
    @endif
@endsection

