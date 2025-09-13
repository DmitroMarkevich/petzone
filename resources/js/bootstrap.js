import Alpine from 'alpinejs'
window.Alpine = Alpine

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
import { initVisibilityToggle } from './modules/ui/visibility.js';

document.addEventListener('DOMContentLoaded', () => {
    initMask();
    initValidation();
    initVisibilityToggle();
});
