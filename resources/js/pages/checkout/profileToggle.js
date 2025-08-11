/**
 * Toggles the profile header and contact info section visibility.
 */
$(document).ready(function () {
    const $profileHeader = $('.profile-header');
    const $profileSection = $('#contact-info');

    const $profileName = $profileHeader.find('.profile-name');

    const $saveButton = $('#save-btn');
    const $editButton = $('#edit-btn');
    const $cancelButton = $('#cancel-btn');

    const inputFieldNames = [
        'recipient_first_name',
        'recipient_last_name',
        'recipient_middle_name',
        'recipient_phone_number'
    ];

    $profileSection.hide();

    const initialUserData = $('#user-data').data('user') || {};

    const $formInputs = Object.fromEntries(
        inputFieldNames.map(name => [name, $(`[name="${name}"]`)])
    );

    const populateFormFields = (data = initialUserData) => {
        inputFieldNames.forEach(name => {
            $formInputs[name].val(data[name] || '');
        });
    };

    const updateProfileName = (data) => {
        const first = data.recipient_first_name || '';
        const last = data.recipient_last_name || '';
        $profileName.text(`${first} ${last}`.trim());
    };

    populateFormFields();
    updateProfileName(initialUserData);

    $editButton.on('click', () => {
        $profileHeader.fadeOut(200, () => $profileSection.fadeIn(200));
    });

    $($cancelButton).on('click', function (e) {
        e.preventDefault();
        populateFormFields(initialUserData);
        $profileSection.fadeOut(200, () => $profileHeader.fadeIn(200));
    });

    $($saveButton).on('click', function (e) {
        e.preventDefault();

        let $formData = Object.fromEntries(
            inputFieldNames.map(name => [
                name, $formInputs[name].val().trim()
            ])
        );
        updateProfileName($formData);

        $profileSection.fadeOut(200, () => $profileHeader.fadeIn(200));
    });
});
