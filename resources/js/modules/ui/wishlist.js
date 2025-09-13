$(document).ready(function() {
    $(document).on('click', '.wishlist-btn', function(e) {
        e.preventDefault();

        const $btn = $(this);
        const $img = $btn.find('img');
        const $form = $btn.closest('.wishlist-form');

        const HEART_EMPTY = "/images/heart.svg";
        const HEART_FILLED = "/images/heart-filled.svg";

        const isActive = $img.data('active') === true;

        function toggleIcon(active) {
            $img.attr('src', active ? HEART_FILLED : HEART_EMPTY);
            $img.data('active', active);
        }

        toggleIcon(!isActive);

        $.post($form.data('action'), {
            _token: $form.find('[name="_token"]').val(),
            advert_id: $btn.data('id')
        }).done(function (data) {
            toggleIcon(data.in_wishlist);
        }).fail(function () {
            toggleIcon(isActive);
        });
    });
});
