$(document).ready(function () {
    const $filterButtons = $('.filter-button');
    const $advertItems = $('.advert-item');

    /**
     * Click handler for filter buttons
     * Filters advert items by their status attribute
     */
    $filterButtons.on('click', function () {
        $filterButtons.removeClass('active');
        $(this).addClass('active');

        const selectedStatus = $(this).data('status');

        $advertItems.each(function () {
            const $item = $(this);

            $item.toggle($item.data('status') === selectedStatus);
        });
    });
});
