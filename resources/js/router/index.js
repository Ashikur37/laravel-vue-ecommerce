import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import About from '../pages/About';
import Register from '../pages/Register';
import Login from '../pages/Login';
import Dashboard from '../pages/Dashboard';

import Category from '../components/Category';
import AddCategory from '../components/AddCategory';
import EditCategory from '../components/EditCategory';

import Product from '../components/Product';
import AddProduct from '../components/AddProduct';
import EditProduct from '../components/EditProduct';
import ViewCategory from '../components/ViewCategory';
import ViewProduct from '../components/ViewProduct';



export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'about',
        path: '/about',
        component: About
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'category',
        path: '/category',
        component: Category
    },
    {
        name: 'addcategory',
        path: '/category/add',
        component: AddCategory
    },
    {
        name: 'editcategory',
        path: '/category/edit/:id',
        component: EditCategory
    },
    {
        name: 'product',
        path: '/product',
        component: Product
    },
    {
        name: 'addproduct',
        path: '/product/add',
        component: AddProduct
    },
    {
        name: 'editproduct',
        path: '/product/edit/:id',
        component: EditProduct
    },
    {
        name: 'viewcategory',
        path: '/category/:id',
        component: ViewCategory
    },
    {
        name: 'viewproduct',
        path: '/product/:slug',
        component: ViewProduct
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
