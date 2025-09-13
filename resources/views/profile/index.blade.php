    @extends('layouts.profile')

    @section('title', 'Мій профіль')

    @section('profile-content')
        <div class="profile-container" x-data="profileData()">
            <div class="profile-header">
                @if (!empty(auth()->user()->image_path))
                    <img x-ref="avatar" src="{{ image_url($user->image_path) }}" alt="Avatar" class="profile-avatar">
                @else
                    <img x-ref="avatar" src="{{ asset('images/default-avatar.png') }}" alt="Avatar" class="profile-avatar">
                @endif

                <div class="profile-info">
                    <h2 class="profile-greeting">Вітаємо, {{ $user->first_name }}!</h2>

                    <div class="profile-actions photo">
                        <form x-ref="photoForm" action="{{ route('profile.uploadAvatar') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="file" x-ref="fileInput" name="profile-photo" class="hidden" accept=".jpeg,.png,.jpg,.svg" @change="handleFileChange">

                            <div class="profile-actions">
                                <button type="button" class="btn-change" x-show="!editingAvatar" @click="$refs.fileInput.click()">
                                    Змінити фото
                                </button>
                                <button type="submit" class="btn-change" x-show="editingAvatar" x-cloak>Зберегти</button>
                                <button type="button" class="btn-cancel" x-show="editingAvatar" @click="cancelPhoto" x-cloak>
                                    Скасувати
                                </button>
                            </div>
                        </form>

                        <form action="{{ route('profile.deleteAvatar') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" x-show="!editingAvatar">
                                <img src="{{ asset('images/profile/bin.svg') }}" alt="Bin Icon">Видалити фото
                            </button>
                        </form>
                    </div>

                    @error('profile-photo')
                        <span class="error-message">*{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="profile-section my-data">
                <h4 class="section-title">
                    <img src="{{ asset('images/profile/profile.svg') }}" alt="Profile">Мої дані
                </h4>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group">
                            <x-form.input type="text" name="first_name" label="Ім'я" value="{{ $user->first_name }}"
                                          maxlength="50" x-bind:readonly="!editingProfile"/>
                        </div>
                        <div class="form-group">
                            <x-form.input type="text" name="last_name" label="Прізвище" value="{{ $user->last_name }}"
                                          maxlength="50" x-bind:readonly="!editingProfile"/>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <x-form.input type="email" name="email" label="Електронна адреса"
                                value="{{ $user->email }}" readonly
                            />
                        </div>
                        <div class="form-group">
                            <x-form.input type="tel" name="phone_number" label="Номер телефону"
                                          placeholder="+38 (0__) ___ __ __" value="{{ $user->phone_number }}"
                                          x-bind:readonly="!editingProfile"/>
                        </div>
                    </div>

                    <a href="#" class="link-icon" x-show="!editingProfile" @click.prevent="editingProfile = true">
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

            <div class="profile-section delivery-address">
                <h4 class="section-title">
                    <img src="{{ asset('images/profile/address.svg') }}" alt="Address">Адреса доставки
                </h4>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group">
                            <x-form.input type="text" name="city" label="Місто"
                                          value="{{ $user->address->city ?? '' }}"
                                          x-bind:readonly="!editingAddress"/>

                            <ul class="address-suggestions hidden"></ul>
                            <input type="hidden" name="ref_delivery_city">
                        </div>
                        <div class="form-group">
                            <x-form.input type="text" name="street" label="Вулиця"
                                          value="{{ $user->address->street ?? '' }}"
                                          x-bind:readonly="!editingAddress"/>

                            <ul class="address-suggestions hidden"></ul>
                            <input type="hidden" name="ref_delivery_street">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group apartment">
                            <x-form.input type="text" name="apartment" label="Квартира"
                                          value="{{ $user->address->apartment ?? '' }}"
                                          x-bind:readonly="!editingAddress"/>
                        </div>
                    </div>

                    <a href="#" class="link-icon" x-show="!editingAddress" @click.prevent="editingAddress = true">
                        <img src="{{ asset('images/profile/pencil.svg') }}" alt="Редагувати">Редагувати
                    </a>

                    <div class="profile-actions">
                        <button type="submit" class="btn-change" x-show="editingAddress" x-cloak>Зберегти</button>
                        <button type="button" class="btn-cancel" x-show="editingAddress" @click="editingAddress = false" x-cloak>
                            Скасувати
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <x-ui.flash-message :message="session('success')"/>
        @elseif(session('error'))
            <x-ui.flash-message :message="session('error')" type="error"/>
        @endif
    @endsection

    <script>
        function profileData() {
            return {
                editingAvatar: false,
                editingProfile: false,
                editingAddress: false,

                originalSrc: '',

                handleFileChange(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    this.originalSrc = this.$refs.avatar.src;
                    this.$refs.avatar.src = URL.createObjectURL(file);
                    this.editingAvatar = true;
                },

                cancelPhoto() {
                    this.$refs.avatar.src = this.originalSrc;
                    this.$refs.fileInput.value = '';
                    this.editingAvatar = false;
                },

                toggleAvatarButtons() {
                    return {
                        showChange: !this.editingAvatar,
                        showSave: this.editingAvatar,
                        showCancel: this.editingAvatar,
                    }
                }
            }
        }
    </script>
