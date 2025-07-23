/**
 * Import jQuery and expose it globally via window.$ and window.jQuery,
 * so that plugins and libraries depending on jQuery work properly.
 */
import $ from 'jquery';
window.$ = window.jQuery = $;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Load Alpine.js — a lightweight JavaScript framework for adding reactive behavior directly in your HTML.
 * It allows you to add interactivity to Blade templates using special attributes.
 */
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

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

/**
 * Import and initialize custom UI modules:
 * - initMask: applies input masks (e.g. phone number formatting)
 * - initValidation: sets up form validation on inputs with data attributes
 * - initVisibilityToggle: toggles password visibility toggles
 * - initVerificationMessage: auto-hides verification messages after a timeout
 */
import { initMask } from './modules/utils/mask.js';
import { initValidation } from './modules/validation/validation.js';
import { initVisibilityToggle } from './modules/ui/visibilityToggle.js';
import { initVerificationMessage } from './modules/ui/verificationMessage.js';

$(document).ready(() => {
    initMask();
    initValidation();
    initVisibilityToggle();
    initVerificationMessage();
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
