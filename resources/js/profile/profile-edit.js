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

    const toggleButtons = (edit, save, cancel, editing) => {
        edit.toggle(!editing);
        save.add(cancel).toggle(editing);
    };

    const toggleEditForm = (edit, save, cancel, inputs, excluded) => {
        edit.on('click', (e) => {
            e.preventDefault();
            toggleFormInputs(inputs, excluded, false);
            toggleButtons(edit, save, cancel, true);
        });
        cancel.on('click', () => {
            toggleFormInputs(inputs, excluded, true);
            toggleButtons(edit, save, cancel, false);
        });
    };

    $('.my-data input, .delivery-address input').each(function () {
        $(this).data('original-value', $(this).val());
    });

    toggleEditForm($('#edit-profile'), $('#save-profile'), $('#cancel-profile'), $('.my-data input'), ['email']);
    toggleEditForm($('#edit-address'), $('#save-address'), $('#cancel-address'), $('.delivery-address input'));
});
