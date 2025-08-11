export const routeModules = {
    register: () => import('@/pages/auth/auth.js'),
    login: () => import('@/pages/auth/auth.js'),
    home: () => import('@/pages/home/home.js'),
    adverts: () => import('@/pages/advert/advert.js'),
    checkout: () => import('@/pages/checkout/checkout.js'),
    profile: () => import('@/pages/profile/profile.js'),
};
