export function initCategoryToggle() {
    $(document).ready(function () {
        const categoryBtn = $("#categoryToggle");
        const categoryMenu = $("#categoryMenu");

        categoryBtn.on("click", function (event) {
            event.stopPropagation();
            categoryMenu.toggleClass("active");
        });

        $(document).on("click", function (event) {
            const target = $(event.target);
            const clickedOnMenu = categoryMenu.is(target) || categoryMenu.has(target).length > 0;
            const clickedOnBtn = categoryBtn.is(target);

            if (!clickedOnMenu && !clickedOnBtn) {
                categoryMenu.removeClass("active");
            }
        });
    });
}
