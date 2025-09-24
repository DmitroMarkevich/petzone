@props(['user'])

<div class="profile-section my-data" x-data="profileEditor()">
    <h4 class="section-title">
        <img src="{{ asset('images/profile/profile.svg') }}" alt="Profile">Мої дані
    </h4>

    <form method="POST" action="{{ route('profile.updateProfile') }}">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="form-group">
                <x-form.input type="text" name="first_name" label="Ім'я" x-bind:readonly="!editingProfile"
                              x-model="firstName"/>
            </div>
            <div class="form-group">
                <x-form.input type="text" name="last_name" label="Прізвище" x-bind:readonly="!editingProfile"
                              x-model="lastName"/>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <x-form.input type="email" name="email" label="Електронна адреса"
                              readonly value="{{ $user->email }}"/>
            </div>
            <div class="form-group">
                <x-form.input type="tel" name="phone_number" label="Номер телефону"
                              x-bind:readonly="!editingProfile"
                              x-model="phoneNumber"/>
            </div>
        </div>

        <a href='' class="link-icon" x-show="!editingProfile" @click.prevent="editingProfile = true">
            <img src="{{ asset('images/profile/pencil.svg') }}" alt="Редагувати">Редагувати
        </a>

        <div class="profile-actions">
            <button type="submit" class="btn-change" x-show="editingProfile" x-cloak>Зберегти</button>
            <button type="button" class="btn-cancel" x-show="editingProfile" @click="editingProfile = false" x-cloak>
                Скасувати
            </button>
        </div>
    </form>
</div>

<script>
    function profileEditor() {
        return {
            editingProfile: false,

            firstName: '{{ $user->first_name }}',
            lastName: '{{ $user->last_name }}',
            phoneNumber: '{{ $user->phone_number }}'
        }
    }
</script>
