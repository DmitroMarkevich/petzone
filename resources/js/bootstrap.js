import Alpine from 'alpinejs'
window.Alpine = Alpine

/**
 * NProgress — a slim progress bar at the top of the page to indicate loading states.
 * Configured here to disable the spinner and set trickle speed.
 */
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

NProgress.configure({
    showSpinner: false,
    trickleSpeed: 200
});

window.NProgress = NProgress;
