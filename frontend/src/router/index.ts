import { createRouter, createWebHistory } from 'vue-router';
import ProductPage from '../pages/ProductPage.vue';
import AddProductPage from '../pages/AddProductPage.vue';

const routes = [
    {
        path: '/',
        name: 'ProductPage',
        component: ProductPage
    },
    {
        path: '/add-product',
        name: 'AddProductPage',
        component: AddProductPage
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;