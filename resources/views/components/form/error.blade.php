@props(['for'])

@if ($errors->has($for))
    <div class="error-message">
        {{ $errors->first($for) }}
    </div>
@endif
