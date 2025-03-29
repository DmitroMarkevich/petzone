/**
 * Toggles password visibility on click.
 * Switches the input text visibility between password and  text.
 */
$(document).ready(function () {
    const eyeOpenUrl = '/images/auth/eye-open.svg';
    const eyeClosedUrl = '/images/auth/eye-closed.svg';

    $(".toggle-visibility").on("click", function () {
        const $input = $(this).prev("input");
        const $icon = $(this).find("img");

        const isPasswordType = $input.attr("type") === "password";
        $input.attr("type", isPasswordType ? "text" : "password");
        $icon.attr("src", isPasswordType ? eyeOpenUrl : eyeClosedUrl);
    });
});
