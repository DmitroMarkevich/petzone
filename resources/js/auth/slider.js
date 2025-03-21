$(document).ready(function () {
    let currentIndex = 0;
    const $imageElement = $("#slider-image");
    const $textElement = $("#slider-text");
    const $dots = $(".dot");

    function changeSlide() {
        currentIndex = (currentIndex + 1) % sliderImages.length;
        $imageElement.attr("src", sliderImages[currentIndex].src);
        $textElement.text(sliderImages[currentIndex].text);

        $dots.each(function (index) {
            $(this).toggleClass("active", index === currentIndex);
        });
    }

    setInterval(changeSlide, 5000);
});
