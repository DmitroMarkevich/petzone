$(document).ready(function () {
    const updatePreview = (input, file) => {
        const label = input.next('.photo-label');
        const reader = new FileReader();

        reader.onload = function () {
            let img = label.find('img');

            if (img.length === 0) {
                img = $('<img>').appendTo(label);
                label.find('.placeholder-text').remove();
            }

            img.attr('src', reader.result);
        };

        reader.readAsDataURL(file);
    };

    const handleFileChange = (input) => {
        const file = input[0].files[0];
        if (!file) return;

        const $upload = input.closest('.photo-upload');
        const isFilled = $upload.attr('data-filled') === 'true';

        if (isFilled) {
            // Заменяем фото в текущей ячейке
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            input[0].files = dataTransfer.files;

            updatePreview(input, file);
            return;
        }

        // Иначе — ищем первую свободную
        const allUploads = $('.photo-upload');
        let targetInput = null;

        allUploads.each(function () {
            const $upload = $(this);
            const isFilled = $upload.attr('data-filled') === 'true';

            if (!isFilled) {
                targetInput = $upload.find('.photo-input')[0];
                return false;
            }
        });

        if (targetInput) {
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            targetInput.files = dataTransfer.files;

            updatePreview($(targetInput), file);
            $(targetInput).closest('.photo-upload').attr('data-filled', 'true');

            if (targetInput !== input[0]) {
                input.val('');
            }
        } else {
            // fallback
            updatePreview(input, file);
            $upload.attr('data-filled', 'true');
        }
    };

    $('.photo-input').on('change', function () {
        handleFileChange($(this));
    });
});
