$(document).on('click', '.favorite-button', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const $button = $(this);
    if ($button.prop('disabled')) return;

    const $form = $button.closest('.wishlist-form');
    const $icon = $button.find('.heart-icon');

    $button.prop('disabled', true);

    $.post($form.data('action'))
        .done(response => {
            $icon.attr('src', `/images/${response.in_wishlist ? 'heart-filled.svg' : 'heart.svg'}`);
        }).always(() => $button.prop('disabled', false));
});
