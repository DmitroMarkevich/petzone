<form method="GET" id="sort-form">
    <label for="sort-options"></label>
    <select name="sort" class="sort-options" id="sort-options">
        @foreach($options as $value => $text)
            <option value="{{ $value }}" @selected($selected === $value)>
                {{ $text }}
            </option>
        @endforeach
    </select>
</form>

@push('scripts')
    <script>
        $('#sort-options').on('change', function () {
            const form = this.form;

            if (!this.value) {
                form.action = new URL(form.action, window.location.origin).pathname;
            }

            form.submit();
        });
    </script>
@endpush
