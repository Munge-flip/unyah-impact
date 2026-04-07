import { createRouter, createWebHistory } from 'vue-router';

// Layouts
const PublicLayout = () => import('../layouts/PublicLayout.vue');
const AuthLayout = () => import('../layouts/AuthLayout.vue');
const ServiceLayout = () => import('../layouts/ServiceLayout.vue');

// Pages
const HomeView = () => import('../views/public/HomeView.vue');
const LoginView = () => import('../views/auth/LoginView.vue');
const RegisterView = () => import('../views/auth/RegisterView.vue');

// Service Views
const GenshinView = () => import('../views/public/GenshinView.vue');
const HsrView = () => import('../views/public/HsrView.vue');
const ZzzView = () => import('../views/public/ZzzView.vue');

const routes = [
    {
        path: '/',
        component: PublicLayout,
        children: [
            {
                path: '',
                name: 'home',
                component: HomeView
            }
        ]
    },
    {
        path: '/services',
        component: ServiceLayout,
        children: [
            {
                path: 'genshin',
                name: 'services.genshin',
                component: GenshinView,
                meta: { 
                    title: 'Genshin Impact Services',
                    banner: '/img/genshin banner.png',
                    gameIcon: '/img/paimon logo.png',
                    gameName: 'Genshin Impact'
                }
            },
            {
                path: 'hsr',
                name: 'services.hsr',
                component: HsrView,
                meta: { 
                    title: 'Honkai Star Rail Services',
                    banner: '/img/hsr banner.png',
                    gameIcon: '/img/hsr icon.png',
                    gameName: 'Honkai Star Rail'
                }
            },
            {
                path: 'zzz',
                name: 'services.zzz',
                component: ZzzView,
                meta: { 
                    title: 'Zenless Zone Zero Services',
                    banner: '/img/zzz banner.png',
                    gameIcon: '/img/zzz icon.png',
                    gameName: 'Zenless Zone Zero',
                    customInstructions: [
                        'Select the service you want.',
                        'Complete your payment.',
                        'The service will be added to your service catalog.',
                        'Wait for an agent to confirm and ask a few questions before proceeding.'
                    ]
                }
            }
        ]
    },
    {
        path: '/',
        component: AuthLayout,
        children: [
            {
                path: 'login',
                name: 'login',
                component: LoginView
            },
            {
                path: 'register',
                name: 'register',
                component: RegisterView
            }
        ]
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
