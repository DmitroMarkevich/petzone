/**
 * Handles the photo upload process for the first photo container.
 * It adds a "Main" label to the container if a file is selected or if an image is already present.
 *
 */
$(document).ready(function () {
    const $firstUpload = $('.photo-upload[data-index="1"]');
    const $firstInput = $firstUpload.find('input[type="file"]');
    const $photoMainLabel = $firstUpload.find('.photo-main-label');

    /**
     * Adds the "Main" label to the photo upload container if it does not already exist.
     */
    const addMainLabel = () => {
        if ($photoMainLabel.length === 0) {
            $('<div>', { class: 'photo-main-label', text: 'Головне' }).appendTo($firstUpload);
        }
    };

    if ($firstUpload.find('img').length > 0) {
        addMainLabel();
    }

    $firstInput.on('change', function () {
        if (this.files.length > 0) addMainLabel();
    });
});
