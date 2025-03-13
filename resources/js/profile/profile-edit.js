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

    // Function to toggle visibility of the edit, save, and cancel buttons
    const toggleButtonsVisibility = (edit, save, cancel, isEditing) => {
        edit.toggle(!isEditing);
        save.add(cancel).toggle(isEditing);
    };

    // Function to handle toggling of edit form
    const handleEditFormToggle = (editButton, saveButton, cancelButton, formInputs, excludedFields) => {
        // Enable edit mode when the edit button is clicked
        editButton.on('click', (e) => {
            e.preventDefault();
            toggleFormInputs(formInputs, excludedFields, false);
            toggleButtonsVisibility(editButton, saveButton, cancelButton, true);
        });

        // Cancel the editing when cancel button is clicked
        cancelButton.on('click', () => {
            toggleFormInputs(formInputs, excludedFields, true);
            toggleButtonsVisibility(editButton, saveButton, cancelButton, false);
        });
    };

    // Store the original values of all form inputs when the page loads
    $('.my-data input, .delivery-address input').each(function () {
        $(this).data('original-value', $(this).val());
    });

    // Handle toggling for profile section
    handleEditFormToggle(
        $('#edit-profile'),
        $('#save-profile'),
        $('#cancel-profile'),
        $('.my-data input'),
        ['email']
    );

    // Handle toggling for delivery address section
    handleEditFormToggle(
        $('#edit-address'),
        $('#save-address'),
        $('#cancel-address'),
        $('.delivery-address input'),
        [] // No exclusions for address fields
    );
});
