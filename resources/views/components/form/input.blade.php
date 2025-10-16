@props([
    'type' => 'text',
    'name',
    'label',
    'placeholder' => '',
    'value' => null,
])

@php
    $value = $value ?? old($name);
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $name }}" style="margin-bottom: 0; display: block;">
            {{ $label }}
        </label>
    @endif

    <div x-data="{ showPassword: false }" class="input-wrapper">
        <input
            id="{{ $name }}"
            :type="showPassword ? 'text' : '{{ $type }}'"
            name="{{ $name }}"
            value="{{ $value }}"
            class="input-field {{ $errors->has($name) ? 'invalid' : '' }}"
            {{ $attributes->merge(['required']) }}
            placeholder="{{ $placeholder }}"
        >

        @if ($type === 'password')
            <button
                type="button"
                @click="showPassword = !showPassword"
                class="toggle-visibility"
                aria-label="Показати/Приховати пароль"
            >
                <img
                    :src="showPassword
                        ? '{{ asset('images/auth/eye-open.svg') }}'
                        : '{{ asset('images/auth/eye-closed.svg') }}'"
                    alt="Toggle visibility"
                >
            </button>
        @endif
    </div>

    @error($name)
    <span class="error-message">*{{ $message }}</span>
    @enderror
</div>
