/**
 * Initializes an automatic image slider.
 */
$(document).ready(function () {
    console.log("Slider script loaded");

    const $sliderContainer = $('#slider-container');

    const sliderTexts = {
        shopping_cart: $sliderContainer.data('shopping-cart'),
        carton: $sliderContainer.data('carton'),
        receipt: $sliderContainer.data('receipt')
    };

    console.log(sliderTexts);

    const sliderImages = [
        { src: "/images/auth/shopping-cart.png", text: sliderTexts.shopping_cart },
        { src: "/images/auth/carton.png", text: sliderTexts.carton },
        { src: "/images/auth/receipt.png", text: sliderTexts.receipt }
    ];

    const $imageElement = $("#slider-image");
    const $textElement = $("#slider-text");
    const $dots = $(".dot");
    let currentIndex = 0;

    setInterval(() => {
        currentIndex = (currentIndex + 1) % sliderImages.length;
        const { src, text } = sliderImages[currentIndex];

        $imageElement.attr("src", src);
        $textElement.text(text);

        $dots.removeClass("active").eq(currentIndex).addClass("active");
    }, 5000);
});
