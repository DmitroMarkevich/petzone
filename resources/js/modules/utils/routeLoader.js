import { routeModules } from '../routes/routeModules';

/**
 * Dynamically loads route-specific JS modules based on the <body data-route> attribute.
 */
export function initRouteLoader() {
    // Get the value of the data-route attribute
    const route = $('body').data('route');
    if (!route) return;

    // Extract the part before the first dot (e.g., "profile.edit" → "profile")
    const baseRoute = route.split('.')[0];

    // Find a matching module either by full route or by base route
    const handler = routeModules[route] || routeModules[baseRoute];
    if (!handler) return;
    handler();
}
