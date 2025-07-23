/**
 * Shows a global loading indicator with NProgress and overlay.
 */
export const showGlobalLoader = () => {
    window.NProgress.start();
    $('#global-loader-overlay').removeClass('hidden');
};

/**
 * Hides the global loading indicator.
 */
export const hideGlobalLoader = () => {
    window.NProgress.done();
    $('#global-loader-overlay').addClass('hidden');
};
