/**
 * Handles the step navigation.
 * When the next-step button is clicked, it shows the second step.
 */
$(document).ready(function () {
    $(".next-step").on("click", function () {
        $(".step-1").removeClass("active");
        $(".step-2").addClass("active");
    });
});
