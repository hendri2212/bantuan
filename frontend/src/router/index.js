import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/Dashboard'
import Disaster from '../components/Disaster'
import AdminDashboard from '../views/Admin/Dashboard'
import AdminDisaster from '../views/Admin/Disaster'
import AdminCreateDisaster from '../components/Admin/Disaster/CreateDisaster'
import AdminUser from '../views/Admin/User'
import AdminProducts from '../views/Admin/Products'

const routes = [
    {
        path: '/register',
        name: 'Register',
        component: () => import('../components/Register.vue'),
        meta: {
          isAdminPage: false,
        },
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../components/Login.vue'),
        meta: {
          isAdminPage: false,
        },
    },
    {
        path        : '/',
        name        : 'Dashboard',
        component   : Dashboard,
        meta: {
          isAdminPage: false,
        },
        // children    : [{
        //     path        : 'disaster/:id',
        //     name        : 'Disaster',
        //     component   : Disaster,
        //     meta        : {
        //         name: 'Disaster'
        //     }
        // }]
    },
    {
        path        : '/disaster/:id',
        name        : 'Disaster',
        component   : Disaster,
        meta        : {
            name    : 'Disaster',
            isAdminPage: false,
        }
    },
    {
        path        : '/product/:id',
        name        : 'Product',
        meta:{
          isAdminPage: false,
        },
        component   : function () {
            return import('../components/Product')
        }
    },
    {
    path: '/admin',
    name: 'Admin',
    meta:{
      isAdminPage: true
    },
    component: function () {
        return import('../views/Admin')
    },
    children:[
      {
        name:'LoginDashboard',
        path: 'login',
        component:AdminDashboard
      },
      {
        name:'AdminDashboard',
        path: '',
        component:AdminDashboard,
        meta: {
          requiresAuth: true,
          title: 'Dashboard'
        },
      },
      {
        name:'AdminDisaster',
        path: 'disaster',
        component:AdminDisaster,
        meta: {
          requiresAuth: true,
          title: 'Disaster'
        },
      },
      {
        name:'AdminCreateDisaster',
        path: 'disaster/create',
        component:AdminCreateDisaster,
        meta: {
          requiresAuth: true,
          title: 'Create Disaster'
        },
      },
      {
        name:'AdminUser',
        path: 'user',
        component:AdminUser,
        meta: {
          requiresAuth: true,
          title: 'User'
        },
      },
      {
        name:'AdminCreateUser',
        path: 'user/create',
        component:AdminCreateDisaster,
        meta: {
          requiresAuth: true,
          title: 'Create User'
        },
      },
      {
        name:'AdminProducts',
        path: 'products',
        component:AdminProducts,
        meta: {
          requiresAuth: true,
          title: 'Products'
        },
      },
      {
        name:'AdminCategory',
        path: 'category',
        component:AdminDashboard,
        meta: {
          requiresAuth: true,
          title: 'Category'
        },
      },
    ]
  }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
