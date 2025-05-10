import 'nprogress/nprogress.css';
import NProgress from 'nprogress';

/**
 * Debounce utility to delay function execution.
 */
export const debounce = (fn, delay) => {
    let timer;
    return function (...args) {
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(this, args), delay);
    };
};

/**
 * Fetch suggestions via AJAX with async/await.
 */
export const fetchData = async (url, data = {}, type = 'GET') => {
    try {
        const response = await $.ajax({ url, type, data });
        return response.success ? response.result : [];
    } catch (error) {
        console.error(`Error fetching data from ${url}:`, error);
        return [];
    }
};

/**
 * Shows a global loading indicator with NProgress and overlay.
 */
export const showGlobalLoader = () => {
    NProgress.start();
    $('#global-loader-overlay').removeClass('hidden');
};

/**
 * Hides the global loading indicator.
 */
export const hideGlobalLoader = () => {
    NProgress.done();
    $('#global-loader-overlay').addClass('hidden');
};
