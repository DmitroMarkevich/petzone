/**
 * Sets up the password show/hide feature.
 * When you click the toggle button, it changes the password field
 * to show or hide the password and changes the icon.
 */
export const initVisibilityToggle = (
    toggleSelector = '.toggle-visibility',
    eyeOpenUrl = '/images/auth/eye-open.svg',
    eyeClosedUrl = '/images/auth/eye-closed.svg'
) => {
    /**
     * Toggles the input type between 'password' and 'text',
     * and switches the eye icon accordingly.
     *
     * @param $input - The password input field
     * @param $icon - The eye icon element
     */
    const togglePasswordVisibility = ($input, $icon) => {
        const isCurrentlyPassword = $input.attr('type') === 'password';

        $input.attr('type', isCurrentlyPassword ? 'text' : 'password');

        const iconSrc = isCurrentlyPassword ? eyeOpenUrl : eyeClosedUrl;
        $icon.attr('src', iconSrc);
    };

    $(document).on('click', toggleSelector, function () {
        const $toggleButton = $(this);
        const $passwordInput = $toggleButton.prev('input');
        const $eyeIcon = $toggleButton.find('img');

        if (!$passwordInput.length || !$eyeIcon.length) return;

        togglePasswordVisibility($passwordInput, $eyeIcon);
    });
};
