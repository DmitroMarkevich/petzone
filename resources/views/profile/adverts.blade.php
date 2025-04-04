@extends('layouts.profile')

@section('profile-content')
    @if($adverts->isEmpty())
        <div class="no-adverts">
            <p>No adverts found.</p>
        </div>
    @else
        <div class="adverts-container">
            <h2 class="page-title">Мої оголошення</h2>

            <div class="adverts-list">
                @foreach($adverts as $advert)
                    <x-advert-item :advert="$advert">
                        <x-slot name="actions">
                            <button class="edit-btn">Редагувати</button>

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
