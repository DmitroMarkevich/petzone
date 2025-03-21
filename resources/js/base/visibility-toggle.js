/**
 * Toggles password visibility on click.
 * Switches the input text visibility between password and  text.
 */
$(document).ready(function () {
    const eyeOpenUrl = '/images/auth/eye-open.svg';
    const eyeClosedUrl = '/images/auth/eye-closed.svg';

    $(".toggle-visibility").on("click", function () {
        let input = $(this).prev("input");
        let icon = $(this).find("img");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.attr("src", eyeOpenUrl);
        } else {
            input.attr("type", "password");
            icon.attr("src", eyeClosedUrl);
        }
    });
});
