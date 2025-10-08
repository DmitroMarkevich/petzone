@props(['action','advert' => null,'categories' => []])

<div x-data="advertForm(@json($advert))">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="advert-form">
        @csrf
        @if($advert)@method('PUT')@endif

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
                        <div class="photo-upload" data-index="{{ $i }}">
                            <input type="file" name="images[]" id="photo-{{ $i }}" accept="image/*"
                                   @change="handleFileUpload($event, {{ $i }})">

                            <label for="photo-{{ $i }}" class="photo-label">
                                <template x-if="uploads[{{ $i }}]?.src">
                                    <img :src="uploads[{{ $i }}].src" alt="Фото" class="uploaded-img">
                                </template>
                                <span x-show="!uploads[{{ $i }}]?.src" class="placeholder-text">+</span>
                            </label>
                        </div>
                    @endfor
                </div>

                <div>
                    <label for="description">Опис товару</label>
                    <textarea id="description" name="description" rows="10" required>{{ old('description', $advert->description ?? '') }}</textarea>
                </div>

                <x-form.select id="advert_condition" name="advert_condition"
                               label="Стан"
                               :options="['new'=>'Новий','used'=>'Б/У']"
                               :selected="old('advert_condition', $advert->advert_condition ?? 'new')"/>

                <x-form.select id="advert_type" name="advert_type"
                               label="Тип"
                               :options="['product'=>'Товар','service'=>'Послуга']"
                               :selected="old('advert_type', $advert->advert_type ?? 'product')"/>

                <x-form.input type="number" name="price" label="Ціна"
                              value="{{ old('price', $advert->price ?? '') }}" required/>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" @click="submitPreview($event)" class="btn-preview">Попередній перегляд</button>
            <button type="submit" class="btn-change">Зберегти</button>
        </div>
    </form>
</div>

<script>
    function advertForm() {
        return {
            uploads: Array.from({ length: 9 }, () => ({ filled: false, src: '' })),

            handleFileUpload(event, index) {
                const file = event.target.files[0];
                if (!file) return;
                this.uploads[index] = {
                    filled: true,
                    src: URL.createObjectURL(file)
                };
            },

            submitPreview(event) {
                const form = event.target.closest('form');
                if (!form) return;

                form.action = "{{ route('advert.preview') }}";
                form.submit();
            }
        }
    }
</script>
