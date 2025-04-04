/**
 * Initializes an automatic image slider.
 */
$(document).ready(function () {
    const sliderImages = [
        { src: "/images/auth/shopping-cart.png", text: "Широкий вибір товарів" },
        { src: "/images/auth/carton.png", text: "Швидка доставка" },
        { src: "/images/auth/receipt.png", text: "Оплата по факту отримання" }
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
