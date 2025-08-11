$(document).ready(function () {
    console.log(1);

    const updatePreview = (input, file) => {
        const $label = input.next('.photo-label');
        const reader = new FileReader();

        reader.onload = function () {
            let $img = $label.find('img');

            if (!$img.length) {
                $img = $('<img alt="Фото">').appendTo($label);
                $label.find('.placeholder-text').remove();
            }

            $img.attr('src', reader.result);
        };

        reader.readAsDataURL(file);
    };

    const addMainLabel = ($upload) => {
        if ($upload.data('index') === 1 && !$upload.find('.photo-main-label').length) {
            $('<div>', { class: 'photo-main-label', text: 'Головне' }).appendTo($upload);
        }
    };

    const handleFileChange = (input) => {
        const file = input[0].files[0];
        if (!file) return;

        const $allUploads = $('.photo-upload');
        const $currentUpload = input.closest('.photo-upload');
        const isCurrentFilled = $currentUpload.attr('data-filled') === 'true';

        if (isCurrentFilled) {
            input[0].files = new DataTransfer().items.add(file).files;
            updatePreview(input, file);

            if ($currentUpload.data('index') === 1) addMainLabel($currentUpload);
            return;
        }

        let targetInput = null;
        $allUploads.each(function () {
            if ($(this).attr('data-filled') !== 'true') {
                targetInput = $(this).find('.photo-input')[0];
                return false;
            }
        });

        if (targetInput) {
            const dt = new DataTransfer();
            dt.items.add(file);
            targetInput.files = dt.files;

            const $targetUpload = $(targetInput).closest('.photo-upload');

            updatePreview($(targetInput), file);
            $targetUpload.attr('data-filled', 'true');

            if ($targetUpload.data('index') === 1) addMainLabel($targetUpload);

            if (targetInput !== input[0]) {
                input.val('');
            }
        } else {
            updatePreview(input, file);
            $currentUpload.attr('data-filled', 'true');

            if ($currentUpload.data('index') === 1) addMainLabel($currentUpload);
        }
    };

    $('.photo-input').on('change', function () {
        handleFileChange($(this));
    });
});
