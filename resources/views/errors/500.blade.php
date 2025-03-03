@extends('layouts.app')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center full-height-container">
        <div class="text-center">
            <h1 class="display-1 text-danger">500</h1>
            <h2 class="mb-4">Internal Server Error</h2>
            <p class="text-muted mb-4">Something went wrong on our side. Please try again later.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
@endsection
