@extends('layouts.profile')

@section('title', 'Створення оголошення')

@section('profile-content')
    <div class="record-container">
        <h2 class="page-title">Створити оголошення</h2>
        <x-advert.form :action="route('advert.store')" :categories="$categories"/>
    </div>
@endsection
