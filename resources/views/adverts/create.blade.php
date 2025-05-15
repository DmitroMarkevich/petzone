@extends('layouts.profile')

@section('profile-content')
    <div class="record-container">
        <h2 class="page-title">Створити оголошення</h2>

        <form action="{{ route('adverts.store') }}" method="POST" enctype="multipart/form-data" class="advert-form">
            @csrf

            <input type="hidden" name="action" id="form-action" value="save">

            <div class="form-main">
                <div class="form-group">
                    <x-input type="text" name="title" label="Заголовок"
                             placeholder="Введіть заголовок товару" value="{{ old('title') }}" required />

                    <x-select id="category_id" name="category_id" label="Категорія"
                              :options="$categories" :selected="old('category_id')"
                              class="form-control" required
                    />

                    <div>
                        <label for="photo-grid">Фото</label>

                        <div id="photo-grid" class="photo-grid">
                            @for ($i = 1; $i <= 8; $i++)
                                <div class="photo-upload" data-index="{{ $i }}">
                                    <input type="file" name="images[]" id="photo-{{ $i }}" accept="image/*"
                                           class="photo-input">

                                    <label for="photo-{{ $i }}" class="photo-label">
                                        <span class="placeholder-text">+</span>
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <label for="description">Опис товару</label>
                        <textarea id="description" name="description" rows="11"
                                  placeholder="Введіть опис товару" required>{{ trim(old('description')) }}</textarea>
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
                        <x-input type="number" name="price" label="Ціна" value="{{ old('price') }}" required/>
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
    'resources/sass/advert/_advert.scss'
])
