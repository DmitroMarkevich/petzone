/**
 * Contains the validation rules for different input fields.
 */
const validations = {
    email: value => /^[\w.-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value),
    password: value => value.length >= 8,
};

export default validations;
