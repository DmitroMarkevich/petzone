$(document).ready(() => {
    const $toggleButtons = $('.toggle-details');

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
});
