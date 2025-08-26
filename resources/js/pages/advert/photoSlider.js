$(document).ready(function () {
    const $mainImage   = $('#mainImage');
    const $thumbnails  = $('.advert-thumbnails img');
    const $buttonLeft  = $('.scroll-btn.left');
    const $buttonRight = $('.scroll-btn.right');

    const images = [];
    $thumbnails.each(function () {
        images.push($(this).attr('src'));
    });

    let currentIndex = 0;

    function updateMainImage(newIndex) {
        currentIndex = newIndex;
        $mainImage.attr('src', images[currentIndex]);
    }

    $buttonLeft.on('click', function () {
        if (currentIndex > 0) {
            updateMainImage(currentIndex - 1);
        }
    });

    $buttonRight.on('click', function () {
        if (currentIndex < images.length - 1) {
            updateMainImage(currentIndex + 1);
        }
    });

    $thumbnails.on('click', function () {
        const index = $thumbnails.index(this);
        updateMainImage(index);
    });
});
