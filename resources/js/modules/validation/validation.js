/**
 * Validation rules.
 */
export const validations = {
    email: value => /^[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value.trim()),
    password: value => value.trim().length >= 8,
};

/**
 * Validate a single input field by its data-validation type.
 */
export const validateInput = ($input) => {
    const validationType = $input.data('validation');
    const validator = validations[validationType];

    if (!validator) return;

    const inputValue = $input.val().trim();
    const isValid = validator(inputValue);

    $input
        .toggleClass('valid', isValid)
        .toggleClass('invalid', inputValue && !isValid);

    return isValid;
};

/**
 * Initialize validation for all fields with data-validation.
 */
export const initValidation = () => {
    $('input[data-validation]').on('input', function () {
        validateInput($(this));
    });
};
