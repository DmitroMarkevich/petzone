/**
 * Automatically hides the verification message box after 3 seconds.
 * Targets the element with id="verification-message" and adds the "hidden" class.
 */
export const initVerificationMessage = () => {
    const $messageBox = $("#verification-message");

    if (!$messageBox.length) return;

    setTimeout(() => {
        $messageBox.addClass("hidden");
    }, 3000);
};
