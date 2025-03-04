/**
 * Toggles password visibility on click.
 * Switches the input text visibility between password and  text.
 */
$(document).ready(function () {
    $(".toggle-visibility").on("click", function () {
        let input = $(this).prev("input");
        let icon = $(this).find("img");

        if (input.attr("type") === "password") {
            input.attr("type", "text");
            icon.attr("src", "{{ asset('images/auth/eye-open.svg') }}");
        } else {
            input.attr("type", "password");
            icon.attr("src", "{{ asset('images/auth/eye-closed.svg') }}");
        }
    });
});
