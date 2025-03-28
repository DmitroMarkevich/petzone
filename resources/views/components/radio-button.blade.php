@php
    $checked = $checked ?? false;
@endphp

<label>
    <input type="radio" name="{{ $name }}" {{ $checked ? 'checked' : '' }}>
    <span class="custom-radio"></span>
    {{ $label }}
</label>
