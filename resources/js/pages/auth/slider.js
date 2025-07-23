/**
 * Initializes an automatic image slider.
 */
$(document).ready(function () {
    const sliderImages = [
        { src: "/images/auth/shopping-cart.png", text: window.sliderTexts.shopping_cart },
        { src: "/images/auth/carton.png", text: window.sliderTexts.carton },
        { src: "/images/auth/receipt.png", text: window.sliderTexts.receipt }
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
