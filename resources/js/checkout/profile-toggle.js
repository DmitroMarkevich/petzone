/**
 * Toggles the profile header and contact info section visibility.
 */
$(document).ready(function () {
    const $profileHeader = $('.profile-header');
    const $profileSection = $('#contact-info');
    const $cancelButton = $('#cancel-btn');

    $profileHeader.on('click', function () {
        $profileHeader.fadeOut(200, function () {
            $profileSection.fadeIn(200);
        });
    });

    $cancelButton.on('click', function (event) {
        event.preventDefault();
        $profileSection.fadeOut(200, function () {
            $profileHeader.fadeIn(200);
        });
    });
});
