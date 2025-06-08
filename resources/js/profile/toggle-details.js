$(document).ready(() => {
    const $toggleButtons = $('.toggle-details');
    const $filterButtons = $('.filter-button');
    const $advertItems = $('.advert-item');

    /**
     * Click handler for toggle details buttons
     * Shows or hides the advert details section
     */
    $toggleButtons.on('click', function () {
        const $item = $(this).closest('.advert-item');
        const $details = $item.find('.advert-details');

        $details.toggle();
        $(this).text($details.is(':visible') ? 'Згорнути' : 'Розгорнути');
    });

    /**
     * Click handler for filter buttons
     * Filters advert items by their status attribute
     */
    $filterButtons.on('click', function () {
        $filterButtons.removeClass('active');
        $(this).addClass('active');

        const selectedStatus = $(this).data('status');

        $advertItems.each(function () {
            const itemStatus = $(this).data('status');
            const shouldShow = !selectedStatus || itemStatus === selectedStatus;
            $(this).toggle(shouldShow);
        });
    });
});
