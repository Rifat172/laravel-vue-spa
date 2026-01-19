import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'products.index',        // или 'home'
        component: () => import('../components/ProductList.vue'),
    },
    {
        path: '/products/create',
        name: 'products.create',
        component: () => import('../components/CreateProduct.vue'),
    },
    {
        path: '/products/:id/edit',
        name: 'products.edit',
        component: () => import('../components/EditProduct.vue'),
        props: true, // автоматически передаёт :id как prop в компонент
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;