import IMask from 'imask';

export const initMask = () => {
    document.querySelectorAll('input[type="tel"]').forEach(input => {
        IMask(input, {
            mask: '+38 (000) 000 00 00'
        });
    });
};
