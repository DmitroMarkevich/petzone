@extends('layouts.app')

@section('title', 'Мій профіль')

@section('app-content')
    <div class="page-container">
        <div class="profile-template" x-data="{ sidebarOpen: false }">
            <div class="profile-sidebar">
                <x-partials.profile.sidebar />
            </div>

            <div class="profile-content">
                @yield('profile-content')
            </div>
        </div>
    </div>
@endsection
