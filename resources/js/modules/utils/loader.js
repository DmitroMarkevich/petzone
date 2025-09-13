/**
 * Shows a global loading indicator with NProgress and overlay.
 */
export const showGlobalLoader = () => {
    window.NProgress.start();

    const overlay = document.getElementById('global-loader-overlay');
    if (overlay) {
        overlay.classList.remove('hidden');
    }
};

/**
 * Hides the global loading indicator.
 */
export const hideGlobalLoader = () => {
    window.NProgress.done();

    const overlay = document.getElementById('global-loader-overlay');
    if (overlay) {
        overlay.classList.add('hidden');
    }
};
