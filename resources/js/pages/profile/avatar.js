/**
 * Handles avatar photo change, preview, and form submission.
 * Provides buttons to change, confirm, cancel, or delete the photo.
 */
$(document).ready(function () {
    const $avatar = $("#profile-avatar"),
        $fileInput = $("#profile-photo"),
        $changeBtn = $("#change-photo-btn"),
        $confirmBtn = $("#confirm-photo-btn"),
        $cancelBtn = $("#cancel-photo-btn"),
        $deleteBtn = $("#delete-photo-btn"),
        $photoForm = $("#photo-form");

    let prevImage = $avatar.attr("src");

    toggleButtons(false);

    $changeBtn.click(() => $fileInput.click());

    // Preview new image when file input changes
    $fileInput.change(e => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = ({ target }) => {
            $avatar.attr("src", target.result);
            toggleButtons(true);
        };
        reader.readAsDataURL(file);
    });

    $confirmBtn.click(() => $photoForm.submit());

    // Reset avatar to the previous image when cancel button is clicked
    $cancelBtn.click(() => {
        $avatar.attr("src", prevImage);
        toggleButtons(false);
    });

    // Show/hide buttons based on the editing state
    function toggleButtons(editing) {
        $confirmBtn.add($cancelBtn).toggleClass("hidden", !editing);
        $changeBtn.add($deleteBtn).toggleClass("hidden", editing);
    }
});
