/**
 * Script for controlling the scroll of a container with items.
 */
$(document).ready(function () {
    let container = $('#popular-adverts');
    let indicator = $('#scroll-indicator span');
    let scrollStep = 300;
    let maxScroll = container[0].scrollWidth - container.outerWidth();

    // Updates the scroll indicator based on the current scroll position
    function updateIndicator() {
        let scrollLeft = container.scrollLeft();
        let percentage = Math.round((scrollLeft / maxScroll) * (indicator.length - 1));
        indicator.removeClass('active');
        $(indicator[percentage]).addClass('active');
    }

    // Click event handlers for scrolling buttons (left and right)
    $('.scroll-btn.left').click(function () {
        container.animate({scrollLeft: '-=' + scrollStep}, 300, updateIndicator);
    });

    $('.scroll-btn.right').click(function () {
        container.animate({scrollLeft: '+=' + scrollStep}, 300, updateIndicator);
    });

    container.scroll(updateIndicator);
});
