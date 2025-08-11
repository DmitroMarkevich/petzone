/**
 * Handles the photo upload in the registration form.
 * Opens the file input dialog when the photo background is clicked,
 * updates the background with the selected image, and hides the preview image once a photo is selected.
 */
$(document).ready(function () {
    const $fileInput = $("#profile-photo");
    const $photoBackground = $("#photo-background");

    $($photoBackground).on("click", function () {
        $($fileInput).click();
    });

    $($fileInput).on("change", function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $($photoBackground).css({"background-image": `url(${e.target.result})`});
                $("#preview-image").hide();
            };
            reader.readAsDataURL(file);
        }
    });
});
