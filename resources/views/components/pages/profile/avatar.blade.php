@props(['user'])

<div class="profile-header" x-data="avatarEditor()">
    <img x-ref="avatar" :src="userAvatar" alt="Avatar" class="profile-avatar">

    <div class="profile-info">
        <h2 class="profile-greeting">Вітаємо, {{ $user->first_name }}!</h2>

        <div class="profile-actions photo">
            <form x-ref="photoForm" action="{{ route('profile.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" x-ref="fileInput" name="profile-photo" class="hidden"
                       accept=".jpeg,.png,.jpg,.svg" @change="handleFileChange">

                <div class="profile-actions">
                    <button type="button" class="btn-change" x-show="!editingAvatar" @click="$refs.fileInput.click()">Змінити фото</button>
                    <button type="submit" class="btn-change" x-show="editingAvatar" x-cloak>Зберегти</button>
                    <button type="button" class="btn-cancel" x-show="editingAvatar" @click="cancelPhoto" x-cloak>Скасувати</button>
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

<script>
    function avatarEditor() {
        return {
            editingAvatar: false,
            userAvatar: '{{ $user->image_path ? image_url($user->image_path) : asset("images/default-avatar.png") }}',
            originalSrc: '',

            handleFileChange(e) {
                const file = e.target.files[0];
                if (!file) return;

                this.originalSrc = this.userAvatar;
                this.userAvatar = URL.createObjectURL(file);
                this.editingAvatar = true;
            },

            cancelPhoto() {
                this.userAvatar = this.originalSrc;
                this.$refs.fileInput.value = '';
                this.editingAvatar = false;
            }
        }
    }
</script>
