@php
    $checked = old('delivery_method') == $value ? 'checked' : '';
@endphp

<label for="{{ $id }}">
    <input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ $checked }}>
    {{ $label }}
</label>
