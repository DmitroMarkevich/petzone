export const showGlobalLoader = () => {
    NProgress.start();
    const overlay = document.getElementById('global-loader-overlay');
    if (overlay) overlay.classList.remove('hidden');
};

export const hideGlobalLoader = () => {
    NProgress.done();
    const overlay = document.getElementById('global-loader-overlay');
    if (overlay) overlay.classList.add('hidden');
};

window.showGlobalLoader = showGlobalLoader;
window.hideGlobalLoader = hideGlobalLoader;
