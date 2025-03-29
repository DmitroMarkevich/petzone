/**
 * Toggles the profile header and contact info section visibility.
 */
$(document).ready(function () {
    const $profileHeader = $('.profile-header');
    const $profileSection = $('#contact-info');
    const $cancelButton = $('#cancel-btn');

    $profileHeader.on('click', function () {
        $profileHeader.hide();
        $profileSection.show();
    });

    $cancelButton.on('click', function () {
        $profileHeader.show();
        $profileSection.hide();
    });
});
