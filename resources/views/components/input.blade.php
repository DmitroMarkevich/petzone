@props(['type' => 'text', 'name', 'label', 'placeholder' => '', 'value' => old($name)])

<label for="{{ $name }}">{{ __($label) }}</label>
<div class="input-wrapper">
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}"
           {{ $attributes->merge(['required']) }} placeholder="{{ $placeholder }}">

    @if ($type === 'password')
        <button type="button" class="toggle-visibility">
            <img id="eye-icon" src="{{ asset('images/auth/eye-closed.svg') }}" alt="Toggle Password">
        </button>
    @endif
</div>
