import Inputmask from "inputmask";

/**
 * Initializes input mask for phone number fields.
 * Applies the mask to the input with type="tel"
 */
export const initMask = () => {
    Inputmask({
        mask: '+38 (099) 999 99 99',
        greedy: false,
        clearIncomplete: true,
        showMaskOnHover: false,
    }).mask('input[type="tel"]');
};
