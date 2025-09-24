<div class="profile-section delivery-address" x-data="addressAutocomplete()">
    <h4 class="section-title">
        <img src="{{ asset('images/profile/address.svg') }}" alt="Address">Адреса доставки
    </h4>

    <form method="POST" action="{{ route('profile.updateAddress') }}" @submit.prevent="validateForm">
        @csrf
        @method('PATCH')

        <div class="form-row">
            <div class="form-group">
                <x-form.input type="text" name="city" label="Місто" x-model="cityTerm"
                    x-bind:readonly="!editingAddress" @input.debounce.300ms="onCityInput"
                />

                <ul x-show="citySuggestions.length > 0" class="address-suggestions">
                    <template x-for="city in citySuggestions" :key="city.DeliveryCity">
                        <li @click="selectCity(city)" x-text="city.Present" class="cursor-pointer"></li>
                    </template>
                </ul>
            </div>

            <div class="form-group">
                <x-form.input type="text" name="street" label="Вулиця" x-model="streetTerm"
                              x-bind:readonly="!editingAddress" @input.debounce.300ms="searchStreets"/>

                <ul x-show="streetSuggestions.length > 0" class="address-suggestions">
                    <template x-for="street in streetSuggestions" :key="street.Ref">
                        <li @click="selectStreet(street)" x-text="street.StreetsType + ' ' + street.Description" class="cursor-pointer"></li>
                    </template>
                </ul>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group apartment">
                <x-form.input type="text" name="apartment" label="Квартира" x-model="apartment" x-bind:readonly="!editingAddress"/>
            </div>
        </div>

        <a href='' class="link-icon" x-show="!editingAddress" @click.prevent="editingAddress = true">
            <img src="{{ asset('images/profile/pencil.svg') }}" alt="Редагувати">Редагувати
        </a>

        <div class="profile-actions">
            <button type="submit" class="btn-change" x-show="editingAddress" x-cloak>Зберегти</button>
            <button type="button" class="btn-cancel" x-show="editingAddress" @click="editingAddress = false" x-cloak>Скасувати</button>
        </div>

        <input type="hidden" name="city" :value="cityValue">
        <input type="hidden" name="city_ref" :value="cityRef">
        <input type="hidden" name="present" :value="cityTerm">
        <input type="hidden" name="area" :value="cityArea">
        <input type="hidden" name="parent_region_code" :value="cityParentRegionCode">
        <input type="hidden" name="parent_region_types" :value="cityParentRegionTypes">
        <input type="hidden" name="settlement_type_code" :value="citySettlementTypeCode">
    </form>
</div>

<script>
    function addressAutocomplete() {
        return {
            cityTerm: '{{ $user->address->present ?? "" }}',
            cityValue: '{{ $user->address->city ?? "" }}',
            cityRef: '{{ $user->address->city_ref ?? "" }}',
            cityArea: '{{ $user->address->area ?? "" }}',
            cityParentRegionCode: '{{ $user->address->parent_region_code ?? "" }}',
            cityParentRegionTypes: '{{ $user->address->parent_region_types ?? "" }}',
            citySettlementTypeCode: '{{ $user->address->settlement_type_code ?? "" }}',
            citySuggestions: [],

            streetTerm: '{{ $user->address->street ?? "" }}',
            streetSuggestions: [],

            apartment: '{{ $user->address->apartment ?? "" }}',
            editingAddress: false,

            async searchCities() {
                if (this.cityTerm.length <= 2) return this.citySuggestions = [];
                try {
                    const res = await fetch(`/address/cities?search=${encodeURIComponent(this.cityTerm)}`);
                    this.citySuggestions = (await res.json()).result[0]?.Addresses || [];
                } catch (e) { console.error(e); }
            },

            selectCity(c) {
                this.cityTerm = c.Present;
                this.cityValue = c.MainDescription;
                this.cityRef = c.DeliveryCity;
                this.cityArea = c.Area;
                this.cityParentRegionCode = c.ParentRegionCode;
                this.cityParentRegionTypes = c.ParentRegionTypes;
                this.citySettlementTypeCode = c.SettlementTypeCode;
                this.citySuggestions = [];
                this.streetTerm = '';
                this.streetSuggestions = [];
            },

            onCityInput() {
                this.cityRef = '';
                this.cityValue = '';
                this.cityArea = '';
                this.cityParentRegionCode = '';
                this.cityParentRegionTypes = '';
                this.citySettlementTypeCode = '';
                this.searchCities();
            },

            async searchStreets() {
                if (!this.cityRef || this.streetTerm.length <= 2) return this.streetSuggestions = [];
                try {
                    const res = await fetch(`/address/streets?cityRef=${this.cityRef}&search=${encodeURIComponent(this.streetTerm)}`);
                    this.streetSuggestions = (await res.json()).result || [];
                } catch (e) { console.error(e); }
            },

            selectStreet(s) {
                this.streetTerm = `${s.StreetsType} ${s.Description}`;
                this.streetSuggestions = [];
            },

            validateForm() {
                if (!this.cityRef || !this.cityTerm.trim()) {
                    alert('Виберіть місто зі списку');
                    return false;
                }

                this.$el.submit();
            }
        }
    }
</script>
