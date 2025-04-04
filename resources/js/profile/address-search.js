$(document).ready(function () {

    /**
     * Debounce utility to delay function execution.
     */
    const debounce = (fn, delay) => {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(this, args), delay);
        };
    };

    /**
     * Fetch suggestions via AJAX with async/await.
     */
    const fetchSuggestions = async (url, data) => {
        try {
            const response = await $.ajax({url, type: 'GET', data});
            return response.success ? response.result : [];
        } catch (error) {
            console.error(`Error ${url}:`, error);
            return [];
        }
    };

    /**
     * Render suggestion list.
     */
    const renderSuggestions = (containerId, items, renderItem) => {
        const container = $(containerId);
        container.empty();

        if (items.length === 0) {
            container.addClass('hidden');
            return;
        }

        items.forEach(item => container.append(renderItem(item)));
        container.removeClass('hidden');
    };

    /**
     * City input handler with debounce
     */
    $('#city').on('input', debounce(async function () {
        const term = $('#city').val();

        if (term.length <= 2) {
            return $('#city-suggestions').addClass('hidden');
        }

        const result = await fetchSuggestions('/address/cities', {search: term});
        const addresses = result[0]?.Addresses || [];

        renderSuggestions('#city-suggestions', addresses, address =>
            `<li data-ref="${address.DeliveryCity}">${address.Present}</li>`
        );
    }, 300));

    /**
     * Set selected city and its reference
     */
    $(document).on('click', '#city-suggestions li', function () {
        $('#city').val($(this).text());
        $('#city-ref').val($(this).data('ref'));
        console.log($(this).data('ref'));
        $('#city-suggestions').addClass('hidden');
    });

    /**
     * Street input handler with debounce
     */
    $('#street').on('input', debounce(async function () {
        const term = $('#street').val();
        const cityRef = $('#city-ref').val();

        if (term.length <= 2 || !cityRef) {
            return $('#street-suggestions').addClass('hidden');
        }

        const streets = await fetchSuggestions('/address/streets', {search: term, cityRef});

        renderSuggestions('#street-suggestions', streets, street =>
            `<li data-ref="${street.Ref}">${street.StreetsType} ${street.Description}</li>`
        );
    }, 300));

    /**
     * Set selected street and its reference
     */
    $(document).on('click', '#street-suggestions li', function () {
        $('#street').val($(this).text());
        $('#street-ref').val($(this).data('ref'));
        console.log($(this).data('ref'));
        $('#street-suggestions').addClass('hidden');
    });
});
