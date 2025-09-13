@extends('layouts.profile')

@section('title', 'Редагування оголошення')

@section('profile-content')
    <div class="record-container">
        <h2 class="page-title">Редагувати оголошення</h2>
        <x-advert.form :action="route('advert.update', $advert)" :advert="$advert" :categories="$categories"/>
    </div>
@endsection
