$(document).ready(function () {
    function toggleEditForm(buttonEdit, buttonSave, buttonCancel, formInputs, excludedFields = []) {
        buttonEdit.on('click', function (e) {
            e.preventDefault();

            formInputs.each(function () {
                const fieldName = $(this).attr('name');
                if (!excludedFields.includes(fieldName)) {
                    $(this).prop('readonly', false).removeClass('readonly');
                }
            });

            buttonSave.add(buttonCancel).show();
            buttonEdit.hide();
        });

        buttonCancel.on('click', function () {
            formInputs.each(function () {
                const fieldName = $(this).attr('name');
                if (!excludedFields.includes(fieldName)) {
                    $(this).val($(this).data('original-value')).prop('readonly', true).addClass('readonly');
                }
            });

            buttonSave.add(buttonCancel).hide();
            buttonEdit.show();
        });
    }

    function saveCurrentValues(selector) {
        $(selector).each(function () {
            $(this).data('original-value', $(this).val());
        });
    }

    saveCurrentValues('.my-data input');
    saveCurrentValues('.delivery-address input');

    toggleEditForm(
        $('#edit-profile'),
        $('#save-profile'),
        $('#cancel-profile'),
        $('.my-data input'),
        ['email']
    );

    toggleEditForm(
        $('#edit-address'),
        $('#save-address'),
        $('#cancel-address'),
        $('.delivery-address input')
    );
});
