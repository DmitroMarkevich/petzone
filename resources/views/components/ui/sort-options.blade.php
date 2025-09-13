<form method="GET"
      x-data="{
          sortValue: '{{ $selected }}',
          submitForm() {
              const form = this.$refs.sortForm;

              if (!this.sortValue) {
                  form.action = new URL(form.action, window.location.origin).pathname;
              }

              form.submit();
          }
      }"
      x-ref="sortForm"
      id="sort-form">

    <label for="sort-options"></label>
    <select name="sort" class="sort-options" id="sort-options" x-model="sortValue" @change="submitForm()">
        @foreach($options as $value => $text)
            <option value="{{ $value }}" @selected($selected === $value)>
                {{ $text }}
            </option>
        @endforeach
    </select>

    @foreach(request()->except('sort', 'page') as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach
</form>

<style>

</style>
