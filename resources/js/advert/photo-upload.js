$(document).ready(function () {
    const updatePreview = (input, file) => {
        const label = input.next('.photo-label');
        const reader = new FileReader();

        reader.onload = function () {
            let img = label.find('img');

            if (img.length === 0) {
                img = $('<img>').appendTo(label);
            }

            img.attr('src', reader.result);
        };

        reader.readAsDataURL(file);
    };

    const handleFileChange = (input) => {
        const file = input[0].files[0];
        if (!file) {
            return;
        }

        const inputs = $('.photo-input');
        const currentIndex = inputs.index(input);

        const firstEmptyInput = inputs
            .slice(0, currentIndex + 1)
            .filter((_, el) => !el.files.length)
            .first();

        const targetInput = firstEmptyInput.length ? firstEmptyInput : input;

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        targetInput[0].files = dataTransfer.files;

        updatePreview(targetInput, file);

        if (targetInput[0] !== input[0]) {
            input.val('');
        }
    };

    $('.photo-input').on('change', function () {
        handleFileChange($(this));
    });
});
