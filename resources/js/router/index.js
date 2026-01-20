import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('../layouts/DefaultLayout.vue'),  // ваш layout
        children: [
            {
                path: '',  // пустой path — это главная страница
                name: 'products.index',
                component: () => import('../components/products/ProductList.vue'),  // путь к вашему ProductList
            },
            {
                path: 'products/create',
                name: 'products.create',
                component: () => import('../components/products/CreateProduct.vue'),
            },
            {
                path: 'products/:id/edit',
                name: 'products.edit',
                component: () => import('../components/products/EditProduct.vue'),
            },
        ],
    },
    // Если позже добавите другие страницы без sidebar — отдельный роут здесь
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;