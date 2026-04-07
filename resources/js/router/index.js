import { createRouter, createWebHistory } from 'vue-router';

// Layouts
const PublicLayout = () => import('../layouts/PublicLayout.vue');
const AuthLayout = () => import('../layouts/AuthLayout.vue');

// Pages
const HomeView = () => import('../views/public/HomeView.vue');
const LoginView = () => import('../views/auth/LoginView.vue');
const RegisterView = () => import('../views/auth/RegisterView.vue');

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
