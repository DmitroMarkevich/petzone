$(document).ready(() => {
    const $toggleButtons = $('.toggle-details');

    /**
     * Click handler for toggle details buttons
     * Shows or hides the advert details section
     */
    function handleToggleDetails(event) {
        const $button = $(event.currentTarget);
        const $advertItem = $button.closest('.advert-item');
        const $detailsSection = $advertItem.find('.advert-details');

        $detailsSection.toggleClass('active');

        const isVisible = $detailsSection.is(':visible');
        $button.text(isVisible ? 'Згорнути' : 'Розгорнути');
    }

    $toggleButtons.on('click', handleToggleDetails);
});
