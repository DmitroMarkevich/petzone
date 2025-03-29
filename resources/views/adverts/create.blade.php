@extends('layouts.app')

@section('app-content')
    <div>
        <h2>Create Product</h2>

        <form action="{{ route('adverts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">Product Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div>
                <label for="description">Product Description</label>
                <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="price">Product Price</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required>
            </div>

            <div>
                <label for="category">Category</label>
                <select id="category" name="category_id" required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="photo-grid">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="photo-upload">
                        <input type="file" name="images[]" id="photo-{{ $i }}" accept="image/*" class="photo-input">
                        <label for="photo-{{ $i }}" class="photo-label">
                            <span class="placeholder-text">+</span>
                        </label>
                    </div>
                @endfor
            </div>

            <button type="submit">Create Product</button>
        </form>
    </div>

    <style>
        .photo-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 20px 0;
        }

        .photo-upload {
            position: relative;
            width: 100%;
            padding-top: 100%;
            border: 2px dashed #ccc;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .photo-upload input[type="file"] {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .photo-upload .photo-label {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #aaa;
            transition: background-color 0.3s, color 0.3s;
        }

        .photo-upload:hover .photo-label {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
        }

        .photo-upload img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }
    </style>
@endsection

@vite(['resources/js/advert/photo-upload.js'])
