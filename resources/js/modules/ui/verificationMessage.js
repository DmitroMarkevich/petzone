/**
 * Automatically hides the verification message box after 3 seconds.
 * Targets the element with id="verification-message" and adds the "hidden" class.
 */
export const initVerificationMessage = () => {
    setTimeout(() => {
        const $messageBox = $("#verification-message");
        if ($messageBox.length) {
            $messageBox.fadeOut(400);
        }
    }, 2000);
};
