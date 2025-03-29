$(document).ready(function () {
    const $messageBox = $("#verification-message");

    if ($messageBox.length) {
        setTimeout(() => {
            $messageBox.addClass("hidden");
        }, 3000);
    }
});
