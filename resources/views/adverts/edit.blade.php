@extends('layouts.profile')

@section('profile-content')
    <div class="record-container">
        <h2 class="page-title">
            <a href="{{ route('profile.adverts') }}">
                <img src="{{ asset('images/left-arrow.svg') }}" alt="Back">
            </a>
            Редагувати оголошення
        </h2>

        <form action="{{ route('adverts.update', $advert->id) }}" method="POST"
              enctype="multipart/form-data" class="advert-form">
            @csrf
            @method('PUT')

            <input type="hidden" name="action" id="form-action" value="save">

            <div class="form-main">
                <div class="form-group">
                    <x-input type="text" name="title" label="Заголовок" value="{{ $advert->title }}"/>

                    <x-select id="category_id" name="category_id" label="Категорія"
                              :options="$categories" :selected="old('category_id')"
                              class="form-control" required
                    />

                    <div>
                        <label for="photo-grid">Фото</label>

                        <div id="photo-grid" class="photo-grid">
                            @for ($i = 1; $i <= 8; $i++)
                                @php
                                    $image = $advert->images[$i - 1] ?? null;
                                @endphp

                                <div class="photo-upload" data-index="{{ $i }}" {{ $image ? 'data-filled=true' : '' }}>
                                    <input type="file" name="images[]" id="photo-{{ $i }}" accept="image/*"
                                           class="photo-input">

                                    <label for="photo-{{ $i }}" class="photo-label">
                                        @if ($image)
                                            <img src="{{ Storage::disk('s3')->url($image->image_path) }}"
                                                 alt="Photo {{ $i }}">
                                        @else
                                            <span class="placeholder-text">+</span>
                                        @endif
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label for="description">Опис товару</label>
                        <textarea id="description" name="description" rows="11"
                                  placeholder="Введіть опис товару">{{ $advert->description }}</textarea>
                    </div>

                    <x-select id="advert_condition" name="advert_condition"
                              label="Стан товару" :options="['new' => 'Новий', 'used' => 'Б/У']"
                              :selected="old('advert_condition', 'new')" class="form-control"
                              required
                    />

                    <x-select id="advert_type" name="advert_type"
                              label="Тип оголошення" :options="['product' => 'Товар', 'service' => 'Послуга']"
                              :selected="old('advert_type', 'product')" class="form-control"
                              required
                    />

                    <div class="short-input-wrapper">
                        <x-input type="number" name="price" label="Ціна" value="{{ $advert->price }}"/>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" name="action" value="preview" class="btn-preview">Попередній перегляд</button>
                <button type="submit" name="action" value="save" class="btn-change">Зберегти</button>
            </div>
        </form>
    </div>
@endsection

@vite([
    'resources/js/advert/index.js',
    'resources/sass/advert/_advert-form.scss'
])

