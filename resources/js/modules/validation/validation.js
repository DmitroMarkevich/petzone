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
export const validateInput = (input) => {
    const validationType = input.dataset.validation;
    const validator = validations[validationType];

    if (!validator) return;

    const value = input.value.trim();
    const isValid = validator(value);

    input.classList.toggle('valid', isValid);
    input.classList.toggle('invalid', value && !isValid);

    return isValid;
};

/**
 * Initialize validation for all fields with data-validation.
 */
export const initValidation = () => {
    const inputs = document.querySelectorAll('input[data-validation]');

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            validateInput(input);
        });
    });
};
