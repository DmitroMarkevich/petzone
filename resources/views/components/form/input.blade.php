@props(['type' => 'text','name', 'label', 'placeholder' => '', 'value' => old($name)])

<div>
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <div class="input-wrapper" x-data="{ showPassword: false }">
        <input
            id="{{ $name }}"
            :type="showPassword ? 'text' : '{{ $type }}'"
            name="{{ $name }}"
            value="{{ $value }}"
            class="input-field {{ $errors->has($name) ? 'invalid' : '' }}"
            {{ $attributes->merge(['required']) }}
            placeholder="{{ $placeholder }}"
            data-validation="{{ $type }}"
        >

        @if ($type === 'password')
            <button
                type="button"
                @click="showPassword = !showPassword"
                class="toggle-visibility"
                aria-label="Показати/Приховати пароль"
            >
                <img
                    src="{{ asset('images/auth/eye-closed.svg') }}"
                    :src="showPassword
                        ? '{{ asset('images/auth/eye-open.svg') }}'
                        : '{{ asset('images/auth/eye-closed.svg') }}'"
                    alt=""
                >
            </button>
        @endif

        @error($name)
        <span class="error-message">*{{ $message }}</span>
        @enderror
    </div>
</div>
