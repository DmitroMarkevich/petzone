import { fetchData } from '@/modules/api/api.js';
import { debounce } from '@/modules/utils/debounce.js';
import { showGlobalLoader, hideGlobalLoader } from '@/modules/utils/loader.js';

$(document).ready(function () {
    const $deliveryInputs = $('input[name="delivery_method"]');
    const WAREHOUSES_URL = '/address/warehouses';

    /**
     * Toggles the visibility of the dropdown panel associated with the clicked input.
     */
    const toggleDropdown = (e) => {
        $(e.currentTarget).siblings('.dropdown-panel').toggle()
    };

    /**
     * Closes all dropdown panels if the click occurred outside a .delivery-extra container.
     */
    const closeDropdowns = (e) => {
        if (!$(e.target).closest('.delivery-extra').length) {
            $('.dropdown-panel').hide();
        }
    };

    /**
     * Handles the selection of a dropdown item. Sets the selected item's text in the input field.
     */
    const selectDropdownItem = (e) => {
        const $item = $(e.currentTarget);
        if ($item.hasClass('no-results')) return;

        const $container = $item.closest('.delivery-extra');
        $container.find('.dropdown-input').val($item.text());
        $container.find('.dropdown-panel').hide();
    };

    /**
     * Renders the list of warehouses in the dropdown panel.
     */
    const renderWarehouses = (containerSelector, warehouses) => {
        const $container = $(containerSelector).empty().removeClass('hidden');

        let itemsHtml;

        if (warehouses.length) {
            itemsHtml = warehouses.map(w => {
                return `<li class="dropdown-item" data-ref="${w.Ref}">${w.Description}</li>`;
            }).join('');
        } else {
            itemsHtml = '<li class="dropdown-item no-results disabled">Немає доступних відділень</li>';
        }

        $container.append(itemsHtml);
    };

    /**
     * Filters the items in the dropdown based on the user's input.
     */
    const filterDropdownItems = (e) => {
        const inputVal = e.target.value.toLowerCase();
        const $panel = $(e.target).siblings('.dropdown-panel');
        const $items = $panel.find('.dropdown-item').not('.no-results');
        let hasMatch = false;

        $items.each(function () {
            const $item = $(this);
            const isMatch = $item.text().toLowerCase().includes(inputVal);
            $item.toggle(isMatch);
            if (isMatch) hasMatch = true;
        });

        $panel.find('.no-results').remove();

        if (!hasMatch) {
            $panel.append('<li class="dropdown-item no-results disabled">За вашим запитом нічого не знайдено</li>');
        }
    };

    /**
     * Handles the change in delivery method, showing or hiding additional sections
     * based on the selected method and fetching the relevant warehouse data.
     */
    const handleDeliveryMethodChange = async function () {
        const method = this.value;
        const $extraSection = $(this).closest('label').find('.delivery-extra');

        $('.delivery-extra').hide();
        $extraSection.length && $extraSection.fadeIn(200);

        let delivery_method, containerId, $blockPostExtra;

        if (method === 'NOVA_POST_SELF_PICKUP') {
            delivery_method = 'nova_post';
            containerId = '#nova-post-branch';
            $blockPostExtra = $('.nova-post-extra');
        } else if (method === 'MEEST_SELF_PICKUP') {
            // TODO: handle MEEST_SELF_PICKUP
        }

        try {
            showGlobalLoader();
            const warehouses = await fetchData(WAREHOUSES_URL, { delivery_method });
            console.log(warehouses);
            renderWarehouses(containerId, warehouses);
            $($blockPostExtra).removeClass('hidden');
        } catch (e) {
            console.log(e);
        } finally {
            hideGlobalLoader();
        }
    };

    // Event listeners for dropdown and delivery method inputs
    $(document)
        .on('click', '.dropdown-input', toggleDropdown)
        .on('click', '.dropdown-item', selectDropdownItem)
        .on('input', '.dropdown-input', filterDropdownItems)
        .on('click', closeDropdowns);

    $deliveryInputs
        .on('change', debounce(handleDeliveryMethodChange, 300))
        .filter(':checked')
        .trigger('change');
});
