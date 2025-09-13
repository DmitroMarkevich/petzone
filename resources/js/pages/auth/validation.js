export function validateEmail(value) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(value.trim());
}

export function validatePassword(value) {
    return value.trim().length >= 8;
}

export function validateStepOne(formEl) {
    let isValid = true;

    const inputs = formEl.querySelectorAll('.step[x-show="step === 1"] input[data-validation]');

    inputs.forEach(input => {
        const value = input.value.trim();
        const type = input.dataset.validation;

        input.classList.remove('invalid');

        if (!value) {
            input.classList.add('invalid');
            isValid = false;
            return;
        }

        switch (type) {
            case 'email':
                if (!validateEmail(value)) {
                    input.classList.add('invalid');
                    isValid = false;
                }
                break;
            case 'password':
                if (!validatePassword(value)) {
                    input.classList.add('invalid');
                    isValid = false;
                }
                break;
        }
    });

    const password = formEl.querySelector('input[name="password"]')?.value || '';
    const confirmation = formEl.querySelector('input[name="password_confirmation"]')?.value || '';
    const confirmInput = formEl.querySelector('input[name="password_confirmation"]');

    if (password !== confirmation && confirmInput) {
        confirmInput.classList.add('invalid');
        isValid = false;
    }

    return isValid;
}
