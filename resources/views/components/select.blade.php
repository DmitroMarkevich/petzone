@props([
    'id',
    'name',
    'label' => '',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Оберіть варіант',
    'required' => false,
    'class' => 'form-control'
])

<div>
    @if($label)
        <label for="{{ $id }}">{{ $label }}</label>
    @endif

    <select id="{{ $id }}" name="{{ $name }}" class="{{ $class }}" {{ $required ? 'required' : '' }}>
            <option value="">{{ $placeholder }}</option>

            @foreach ($options as $key => $value)
                @php
                    $optionValue = is_object($value) ? $value->id : $key;
                    $optionLabel = is_object($value) ? $value->name : $value;
                    $isSelected = old($name, $selected) == $optionValue;
                @endphp
                <option value="{{ $optionValue }}" {{ $isSelected ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
    </select>
</div>
