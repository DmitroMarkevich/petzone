@extends('layouts.profile')

@section('title', 'Мій профіль')

@section('profile-content')
    <div class="profile-container">
        <x-pages.profile.avatar :user="$user"/>
        <x-pages.profile.personal-data-form :user="$user"/>
        <x-pages.profile.address-form :user="$user"/>
    </div>
@endsection
