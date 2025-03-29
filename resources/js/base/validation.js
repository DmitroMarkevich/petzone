/**
 * Real-time form validation based on predefined rules.
 * Automatically applies validation to fields with the 'data-validation' attribute.
 */
import validations from './validation-rules.js';

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
