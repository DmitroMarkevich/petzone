/**
 * Handles real-time form validation for input fields.
 * Adds "valid" or "invalid" classes based on the input value and validation result.
 */
$(document).ready(function () {
    const validations = {
        email: value => /^[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value),
        password: value => value.length >= 8,
    };

    $('input[data-validation]').each(function () {
        $(this).on('input', function () {
            const $input = $(this);
            const validationType = $input.data('validation');

            if (!validationType || !validations[validationType]) {
                return;
            }

            const inputValue = $input.val();
            const isValid = validations[validationType](inputValue);

            if (inputValue) {
                $input.toggleClass("valid", isValid).toggleClass("invalid", !isValid);
            } else {
                $input.removeClass("valid invalid");
            }
        });
    });
});
