/**
 * Initializes input mask for phone number fields.
 * Applies the mask to the input with id="phone_number".
 */
export const initMask = () => {
    $('#phone_number').mask('+38 (099) 999 99 99');
};
