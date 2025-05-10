/**
 * Real-time form validation based on predefined rules.
 * Automatically applies validation to fields with the 'data-validation' attribute.
 */
const validations = {
    email: value => /^[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value),
    password: value => value.length >= 8,
};

$(document).ready(function () {
    $('input[data-validation]').on('input', function () {
        const $input = $(this);
        const validationType = $input.data('validation');
        const validator = validations[validationType];

        if (!validator) return;

        const inputValue = $input.val();
        $input.toggleClass("valid", validator(inputValue))
            .toggleClass("invalid", inputValue && !validator(inputValue));
    });
});
