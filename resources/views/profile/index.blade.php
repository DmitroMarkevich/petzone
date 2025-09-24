@extends('layouts.profile')

@section('title', 'Мій профіль')

@section('profile-content')
    <div class="profile-container">
        <x-pages.profile.avatar :user="$user" />
        <x-pages.profile.personal-data-form :user="$user" />
        <x-pages.profile.address-form :user="$user" />
    </div>

    @if(session('success'))
        <x-ui.flash-message :message="session('success')"/>
    @elseif(session('error'))
        <x-ui.flash-message :message="session('error')" type="error"/>
    @endif
@endsection
