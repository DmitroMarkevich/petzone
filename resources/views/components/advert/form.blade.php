@props(['action','advert' => null,'categories' => []])

<div x-data="advertForm(@json($advert))">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="advert-form">
        @csrf
        @if($advert)
            @method('PUT')
        @endif

        <input type="hidden" name="action" id="form-action" value="save">

        <div class="form-main">
            <div class="form-group">
                <x-form.input type="text" name="title" label="Заголовок"
                              value="{{ old('title', $advert->title ?? '') }}"
                              placeholder="Введіть заголовок товару" required/>

                <x-form.select id="category_id" name="category_id" label="Категорія"
                               :options="$categories"
                               :selected="old('category_id', $advert->category_id ?? null)"
                               class="form-control" required/>

                <div class="photo-grid">
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $image = $advert->images[$i - 1] ?? null;
                        @endphp

                        <div class="photo-upload" x-bind:data-filled="uploads[{{ $i }}].filled" data-index="{{ $i }}">
                            <input type="file"
                                   name="images[]"
                                   id="photo-{{ $i }}"
                                   accept="image/*"
                                   class="photo-input"
                                   @change="handleFileUpload($event, {{ $i }})">

                            <label for="photo-{{ $i }}" class="photo-label">
                                <img x-show="uploads[{{ $i }}].src" x-bind:src="uploads[{{ $i }}].src" alt="Фото">
                                <span x-show="!uploads[{{ $i }}].src" class="placeholder-text">+</span>
                            </label>

                            <div x-show="{{ $i }} === 1 && uploads[{{ $i }}].filled" class="photo-main-label" x-cloak>
                                Головне
                            </div>

                            @if($image)
                                <img src="{{ image_url($image->image_path) }}" class="existing-photo" alt="Фото {{ $i }}">
                            @endif
                        </div>
                    @endfor
                </div>

                <div>
                    <label for="description">Опис товару</label>
                    <textarea id="description" name="description" rows="11"
                              placeholder="Введіть опис товару"
                              required>{{ old('description', $advert->description ?? '') }}</textarea>
                </div>

                <x-form.select id="advert_condition" name="advert_condition"
                               label="Стан товару"
                               :options="['new' => 'Новий', 'used' => 'Б/У']"
                               :selected="old('advert_condition', $advert->advert_condition ?? 'new')"
                               class="form-control" required/>

                <x-form.select id="advert_type" name="advert_type"
                               label="Тип оголошення"
                               :options="['product' => 'Товар', 'service' => 'Послуга']"
                               :selected="old('advert_type', $advert->advert_type ?? 'product')"
                               class="form-control" required/>

                <div class="short-input-wrapper">
                    <x-form.input type="number" name="price" label="Ціна"
                                  value="{{ old('price', $advert->price ?? '') }}" required/>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" name="action" value="preview" class="btn-preview">Попередній перегляд</button>
            <button type="submit" name="action" value="save" class="btn-change">Зберегти</button>
        </div>
    </form>
</div>

<script>
function advertForm(advert = null) {
    return {
        uploads: Array.from({length: 9}, (_, i) => ({
            filled: !!(advert?.images[i-1] ?? false),
            src: advert?.images[i-1]?.image_path ? "{{ url('storage') }}/" + advert.images[i-1].image_path : ''
        })),

        handleFileUpload(event, index) {
            const file = event.target.files[0];
            if (!file) return;

            const targetIndex = this.findTargetSlot(index);
            this.setFileToSlot(file, targetIndex);

            if (targetIndex !== index) {
                event.target.value = '';
            }
        },

        findTargetSlot(currentIndex) {
            if (!this.uploads[currentIndex].filled) return currentIndex;

            for (let i = 1; i <= 8; i++) {
                if (!this.uploads[i].filled) return i;
            }
            return currentIndex;
        },

        setFileToSlot(file, index) {
            this.uploads[index].filled = true;
            this.uploads[index].src = URL.createObjectURL(file);

            const input = document.getElementById(`photo-${index}`);
            if (input) {
                const dt = new DataTransfer();
                dt.items.add(file);
                input.files = dt.files;
            }
        }
    }
}
</script>
