@props(['type' => 'text', 'name', 'label', 'placeholder' => '', 'value' => old($name)])

<div>
    <label for="{{ $name }}">{{ __($label) }}</label>

    <div class="input-wrapper">
        <input
            id="{{ $name }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ $value }}"
            class="input-field {{ $errors->has($name) ? 'invalid' : '' }}"
            {{ $attributes->merge(['required']) }}
            placeholder="{{ $placeholder }}"
            data-validation="{{ $type }}"
        >

        @if ($type === 'password')
            <button type="button" class="toggle-visibility">
                <img id="eye-icon" src="{{ asset('images/auth/eye-closed.svg') }}" alt="Toggle Visibility">
            </button>
        @endif

        @error($name)
            <span class="error-message">*{{ $message }}</span>
        @enderror
    </div>
</div>
