/**
 * Handles toggling of form inputs between editable and read-only states and visibility of the associated buttons.
 */
$(document).ready(function () {
    const toggleFormInputs = (inputs, excluded, readonly) => {
        inputs.each(function () {
            const $input = $(this);

            if (!excluded.includes($input.attr('name'))) {
                $input.prop('readonly', readonly).toggleClass('readonly', readonly);

                if (readonly) {
                    $input.val($input.data('original-value'));
                }
            }
        });
    };

    const toggleButtonsVisibility = (edit, save, cancel, isEditing) => {
        edit.toggle(!isEditing);
        save.add(cancel).toggle(isEditing);
    };

    const handleEditFormToggle = (editButton, saveButton, cancelButton, formInputs, excludedFields) => {
        editButton.on('click', (e) => {
            e.preventDefault();
            toggleFormInputs(formInputs, excludedFields, false);
            toggleButtonsVisibility(editButton, saveButton, cancelButton, true);
        });

        cancelButton.on('click', () => {
            toggleFormInputs(formInputs, excludedFields, true);
            toggleButtonsVisibility(editButton, saveButton, cancelButton, false);
        });
    };

    $('.my-data input, .delivery-address input').each(function () {
        $(this).data('original-value', $(this).val());
    });

    handleEditFormToggle(
        $('#edit-profile'),
        $('#save-profile'),
        $('#cancel-profile'),
        $('.my-data input'),
        ['email']
    );

    handleEditFormToggle(
        $('#edit-address'),
        $('#save-address'),
        $('#cancel-address'),
        $('.delivery-address input'),
        []
    );
});
