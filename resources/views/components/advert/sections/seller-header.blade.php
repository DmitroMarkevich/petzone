@props(['seller', 'created_at'])

<div class="seller-header">
    <img src="{{ image_url($seller->image_path, 'images/default-avatar.png') }}"
         class="seller-avatar" alt="Seller Avatar">

    <div>
        <a href="{{ route('user.show', $seller->id) }}" class="seller-name">
            {{ $seller->first_name }} {{ $seller->last_name }}
        </a>
        <p class="seller-date">Posted: {{ $created_at }}</p>
    </div>
</div>
