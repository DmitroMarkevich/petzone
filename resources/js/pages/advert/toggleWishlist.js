$(document).on('click', '.favorite-button', function (event) {
    event.preventDefault();
    event.stopPropagation();

    const $button = $(this);
    if ($button.prop('disabled')) return; // Prevent double clicks

    const $icon = $button.find('.heart-icon');
    const originalSrc = $icon.attr('src');

    // Check heart icon is filled or not
    const isWishlist = originalSrc.includes('heart-filled.svg');

    // Change the icon first to show the user it worked
    $icon.attr('src', getToggledIconSrc(originalSrc, !isWishlist));

    $button.prop('disabled', true);

    const actionUrl = $button.closest('form').data('action');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.post(actionUrl, {_token: csrfToken})
        .done(response => {
            $icon.attr('src', getToggledIconSrc(originalSrc, response.in_wishlist));
        })
        .fail(() => {
            $icon.attr('src', originalSrc);
        })
        .always(() => {
            $button.prop('disabled', false);
        });
});

// Function to toggle heart icon src between filled and empty
function getToggledIconSrc(currentSrc, filled) {
    return filled
        ? currentSrc.replace('heart.svg', 'heart-filled.svg')
        : currentSrc.replace('heart-filled.svg', 'heart.svg');
}
