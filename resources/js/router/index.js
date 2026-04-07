import { createRouter, createWebHistory } from 'vue-router';

// Layouts
const PublicLayout = () => import('../layouts/PublicLayout.vue');
const AuthLayout = () => import('../layouts/AuthLayout.vue');
const ServiceLayout = () => import('../layouts/ServiceLayout.vue');
const UserLayout = () => import('../layouts/UserLayout.vue');

// Pages
const HomeView = () => import('../views/public/HomeView.vue');
const LoginView = () => import('../views/auth/LoginView.vue');
const RegisterView = () => import('../views/auth/RegisterView.vue');

// User Pages
const UserDashboardView = () => import('../views/user/UserDashboardView.vue');
const UserEditInfoView = () => import('../views/user/UserEditInfoView.vue');
const UserEditPasswordView = () => import('../views/user/UserEditPasswordView.vue');
const UserOrdersIndexView = () => import('../views/user/UserOrdersIndexView.vue');
const UserOrderShowView = () => import('../views/user/UserOrderShowView.vue');
const UserTransactionsIndexView = () => import('../views/user/UserTransactionsIndexView.vue');
const UserTransactionShowView = () => import('../views/user/UserTransactionShowView.vue');

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
        path: '/user',
        component: UserLayout,
        children: [
            {
                path: '',
                name: 'user.dashboard',
                component: UserDashboardView
            },
            {
                path: 'edit',
                name: 'user.dashboard.edit',
                component: UserEditInfoView
            },
            {
                path: 'update',
                name: 'user.dashboard.update',
                component: UserEditPasswordView
            },
            {
                path: 'order',
                name: 'user.order',
                component: UserOrdersIndexView
            },
            {
                path: 'order/:id',
                name: 'user.order.show',
                component: UserOrderShowView
            },
            {
                path: 'transactions',
                name: 'user.transactions',
                component: UserTransactionsIndexView
            },
            {
                path: 'transactions/:id',
                name: 'user.transactions.show',
                component: UserTransactionShowView
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
