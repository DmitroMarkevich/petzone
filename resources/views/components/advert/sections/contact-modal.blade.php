@props(['seller'])

<div x-data="{ modalOpen: false, modalContent: '', copied: false }">
    @if($seller->phone)
        <button class="seller-btn" @click="modalContent = '{{ $seller->phone }}'; modalOpen = true">
            Переглянути номер телефону
        </button>
    @endif

    <button class="seller-btn" @click="modalContent = '{{ $seller->email }}'; modalOpen = true">
        Показати електронну пошту
    </button>

    <div x-show="modalOpen" x-transition class="mobile-search-modal" @click.outside="modalOpen = false" x-cloak>
        <div class="modal-content">
            <input type="text" x-model="modalContent" class="modal-input" readonly autofocus>
            <button type="button" class="modal-search-btn"
                    @click="navigator.clipboard.writeText(modalContent); copied = true; setTimeout(() => copied = false, 2000)">
                Скопіювати
            </button>
            <button @click="modalOpen = false" class="modal-close-btn">&times;</button>
            <div x-show="copied" class="copy-success-message">Текст успішно скопійовано!</div>
        </div>
    </div>
</div>
