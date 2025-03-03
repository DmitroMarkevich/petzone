$(document).ready(function () {
    const $fileInput = $("#logo");
    const $changePhotoBtn = $("#change-photo-btn");
    const $confirmPhotoBtn = $("#confirm-photo-btn");
    const $cancelPhotoBtn = $("#cancel-photo-btn");
    const $profileAvatar = $("#profile-avatar");
    const $deletePhotoBtn = $("#delete-photo-btn");
    let previousImage = $profileAvatar.attr("src");

    $changePhotoBtn.on("click", function () {
        $fileInput.click();
    });

    $fileInput.on("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            let reader = new FileReader();

            reader.onload = function (e) {
                $profileAvatar.attr("src", e.target.result);
                $changePhotoBtn.hide();
                $confirmPhotoBtn.show();
                $cancelPhotoBtn.show();
                $deletePhotoBtn.hide();
            };
            reader.readAsDataURL(file);
        }
    });

    $confirmPhotoBtn.on("click", function () {
        $("#photo-form").submit();
    });

    $cancelPhotoBtn.on("click", function () {
        $profileAvatar.attr("src", previousImage);
        $changePhotoBtn.show();
        $confirmPhotoBtn.hide();
        $cancelPhotoBtn.hide();
        $deletePhotoBtn.show();
    })
});
