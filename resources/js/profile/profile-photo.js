$(document).ready(function () {
    const $avatar = $("#profile-avatar"),
        $fileInput = $("#profile-photo"),
        $changeBtn = $("#change-photo-btn"),
        $confirmBtn = $("#confirm-photo-btn"),
        $cancelBtn = $("#cancel-photo-btn"),
        $deleteBtn = $("#delete-photo-btn"),
        $photoForm = $("#photo-form");

    let prevImage = $avatar.attr("src");

    $changeBtn.click(() => $fileInput.click());

    $fileInput.change(e => {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = e => {
            $avatar.attr("src", e.target.result);
            toggleButtons(true);
        };
        reader.readAsDataURL(file);
    });

    $confirmBtn.click(() => $photoForm.submit());

    $cancelBtn.click(() => {
        $avatar.attr("src", prevImage);
        toggleButtons(false);
    });

    function toggleButtons(editing) {
        $changeBtn.add($deleteBtn).toggle(!editing);
        $confirmBtn.add($cancelBtn).toggle(editing);
    }
});
