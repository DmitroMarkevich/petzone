@props(['user'])

<div class="container-item" x-data="recipientForm(@js($user ?? new stdClass()))">
    <h3>Отримувач</h3>

    <div class="profile-header" x-show="!editing">
        <span class="profile-name" x-text="displayName"></span>
        <a class="link-edit" @click="startEdit">Змінити</a>
    </div>

    <div class="profile-section" x-show="editing" x-transition>
        <div class="form-row">
            <div class="form-group">
                <x-form.input type="text" name="recipient_first_name" label="Ім'я"
                              x-model="form.recipient_first_name"/>
            </div>
            <div class="form-group">
                <x-form.input type="text" name="recipient_last_name" label="Прізвище"
                              x-model="form.recipient_last_name"/>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <x-form.input type="text" name="recipient_middle_name" label="По батькові"
                              x-model="form.recipient_middle_name"/>
            </div>
            <div class="form-group">
                <x-form.input type="tel" name="recipient_phone_number" label="Номер телефону"
                              x-model="form.recipient_phone_number"/>
            </div>
        </div>

        <div class="profile-actions">
            <button class="btn-change" type="button" @click="saveChanges">Зберегти</button>
            <button class="btn-cancel" type="button" @click="cancelEdit">Скасувати</button>
        </div>
    </div>

    <script>
        function recipientForm(user) {
            user = user || {};

            const initialData = {
                recipient_first_name: user.first_name || '',
                recipient_last_name: user.last_name || '',
                recipient_middle_name: user.middle_name || '',
                recipient_phone_number: user.phone_number || ''
            };

            return {
                editing: false,
                form: {...initialData},
                original: {...initialData},

                get displayName() {
                    const first = this.form.recipient_first_name || '';
                    const last = this.form.recipient_last_name || '';
                    return `${first} ${last}`.trim();
                },

                startEdit() {
                    this.editing = true;
                },

                saveChanges() {
                    this.original = {...this.form};
                    this.editing = false;
                },

                cancelEdit() {
                    this.form = {...this.original};
                    this.editing = false;
                }
            }
        }
    </script>
</div>
