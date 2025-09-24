<div class="container-item" x-data="deliveryMethods()" @click.away="closeDropdown()">
    <h3>Доставка</h3>

    <label for="NOVA_POST_SELF_PICKUP" class="delivery-method">
        <div class="delivery-header">
            <span class="radio-label">
                <input type="radio"
                       id="NOVA_POST_SELF_PICKUP"
                       name="delivery_method"
                       value="NOVA_POST_SELF_PICKUP"
                       x-model="selectedMethod"
                       @change="onDeliveryMethodChange('nova_post')">
                <span class="delivery-name">{{ __('delivery.NOVA_POST_SELF_PICKUP') }}</span>
            </span>
            <span class="delivery-price">50 грн</span>
        </div>

        <div class="delivery-extra" x-show="selectedMethod === 'NOVA_POST_SELF_PICKUP'" x-cloak>
            <input type="text"
                   class="dropdown-input"
                   :readonly="deliveryServices.nova_post.selected && !deliveryServices.nova_post.dropdownVisible"
                   placeholder="Оберіть відділення"
                   x-model="deliveryServices.nova_post.query"
                   @focus="deliveryServices.nova_post.dropdownVisible = true"
                   @input="filterBranches('nova_post')"
                   autocomplete="off"
                   :class="{'error-border': deliveryServices.nova_post.validationError}"
            />

            <ul class="dropdown-panel"
                x-show="deliveryServices.nova_post.dropdownVisible && deliveryServices.nova_post.filteredBranches.length > 0">
                <template x-for="(branch, index) in deliveryServices.nova_post.filteredBranches" :key="branch.Ref">
                    <li class="dropdown-item"
                        @click.prevent="selectBranch('nova_post', branch)"
                        x-text="branch.Description"></li>
                </template>
            </ul>
        </div>
    </label>

    <label for="MEEST_SELF_PICKUP" class="delivery-method">
        <div class="delivery-header">
            <span class="radio-label">
                <input type="radio"
                       id="MEEST_SELF_PICKUP"
                       name="delivery_method"
                       value="MEEST_SELF_PICKUP"
                       x-model="selectedMethod"
                       @change="onDeliveryMethodChange('meest')">
                <span class="delivery-name">{{ __('delivery.MEEST_SELF_PICKUP') }}</span>
            </span>
        </div>

        <div class="delivery-extra" x-show="selectedMethod === 'MEEST_SELF_PICKUP'" x-cloak>
            <input type="text"
                   class="dropdown-input"
                   :readonly="deliveryServices.meest.selected && !deliveryServices.meest.dropdownVisible"
                   placeholder="Оберіть відділення"
                   x-model="deliveryServices.meest.query"
                   @focus="deliveryServices.meest.dropdownVisible = true"
                   @input="filterBranches('meest')"
                   autocomplete="off"
                   :class="{'error-border': deliveryServices.meest.validationError}"
            />

            <ul class="dropdown-panel"
                x-show="deliveryServices.meest.dropdownVisible && deliveryServices.meest.filteredBranches.length > 0">
                <template x-for="(branch, index) in deliveryServices.meest.filteredBranches" :key="index">
                    <li class="dropdown-item"
                        @click.prevent="selectBranch('meest', branch)"
                        x-text="branch.ShortAddress || branch.Description || branch"></li>
                </template>
            </ul>
        </div>
    </label>

    <input type="hidden" name="warehouse_ref" x-model="warehouse_ref">
    <input type="hidden" name="warehouse_title" x-model="warehouse_title">
    <input type="hidden" name="warehouse_settlement_type" x-model="warehouse_settlement_type">
    <input type="hidden" name="warehouse_city" x-model="warehouse_city">
    <input type="hidden" name="warehouse_region" x-model="warehouse_region">

    <x-form.error for="delivery_method"/>
</div>

<script>
    function deliveryMethods() {
        return {
            selectedMethod: '',

            warehouse_ref: '',
            warehouse_title: '',
            warehouse_settlement_type: '',
            warehouse_city: '',
            warehouse_region: '',

            deliveryServices: {
                nova_post: {
                    branches: [],
                    filteredBranches: [],
                    query: '',
                    selected: false,
                    selectedBranch: null,
                    validationError: false,
                    dropdownVisible: false
                },
                meest: {
                    branches: [],
                    filteredBranches: [],
                    query: '',
                    selected: false,
                    selectedBranch: null,
                    validationError: false,
                    dropdownVisible: false
                },
            },

            onDeliveryMethodChange(service) {
                Object.keys(this.deliveryServices).forEach(key => {
                    const s = this.deliveryServices[key];
                    s.branches = [];
                    s.filteredBranches = [];
                    s.query = '';
                    s.selected = false;
                    s.selectedBranch = null;
                    s.validationError = false;
                    s.dropdownVisible = false;
                });

                this.warehouse_ref = '';
                this.warehouse_title = '';

                this.fetchWarehouses(service);
            },

            fetchWarehouses(service) {
                showGlobalLoader();

                fetch(`/address/warehouses?delivery_method=${service}`)
                    .then(response => response.json())
                    .then(data => {
                        const branches = Array.isArray(data.result) ? data.result : [];
                        const s = this.deliveryServices[service];
                        s.branches = branches;
                        s.filteredBranches = branches;
                        s.dropdownVisible = true;
                    })
                    .catch(error => {
                        console.error('Ошибка загрузки отделений:', error);
                    })
                    .finally(() => hideGlobalLoader());
            },

            filterBranches(service) {
                const s = this.deliveryServices[service];
                const query = s.query.toLowerCase().trim();

                s.selected = false;
                s.selectedBranch = null;
                s.validationError = false;
                s.dropdownVisible = true;

                s.filteredBranches = s.branches.filter(branch => {
                    const text = `${branch.ShortAddress || ''} ${branch.Description || ''}`.toLowerCase();
                    return text.includes(query);
                });
            },

            selectBranch(service, branch) {
                const s = this.deliveryServices[service];
                s.query = branch.Description || '';
                s.selected = true;
                s.selectedBranch = branch;
                s.validationError = false;
                s.dropdownVisible = false;

                this.warehouse_ref = branch.Ref || '';
                this.warehouse_title = branch.Description || '';
                this.warehouse_settlement_type = branch.SettlementTypeDescription || '';
                this.warehouse_city = branch.SettlementDescription || '';
                this.warehouse_region = branch.SettlementAreaDescription || '';
            },

            closeDropdown() {
                Object.values(this.deliveryServices).forEach(s => s.dropdownVisible = false);
            },

            validateSelection() {
                const DELIVERY_METHODS = {NOVA_POST_SELF_PICKUP: 'nova_post', MEEST_SELF_PICKUP: 'meest'};
                const selectedService = DELIVERY_METHODS[this.selectedMethod] || null;

                if (selectedService && !this.deliveryServices[selectedService].selected) {
                    this.deliveryServices[selectedService].validationError = true;
                    return false;
                }

                return true;
            }
        }
    }
</script>
