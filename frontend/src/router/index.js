import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/Dashboard'
import Disaster from '../components/Disaster'
import AdminDashboard from '../views/Admin/Dashboard'
import AdminDisaster from '../views/Admin/Disaster'
import AdminCreateDisaster from '../components/Admin/Disaster/CreateDisaster'
import AdminUpdateDisaster from '../components/Admin/Disaster/UpdateDisaster'
import AdminCategory from '../views/Admin/Category'
import AdminCreateCategory from '../components/Admin/Category/CreateCategory'
import AdminUpdateCategory from '../components/Admin/Category/UpdateCategory'
import AdminUser from '../views/Admin/User'
import AdminProducts from '../views/Admin/Products'
import AdminAccount from '../views/Admin/AdminAccount'
import AdminCreateAdmin from '../components/Admin/AdminAccount/CreateAdminAccount'
import AdminUpdateAdmin from '../components/Admin/AdminAccount/UpdateAdminAccount'
import AdminLogin from '../views/Admin/Login'

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
        name:'AdminLogin',
        path: 'login',
        component:AdminLogin
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
        name:'AdminUpdateDisaster',
        path: 'disaster/:id',
        component:AdminUpdateDisaster,
        meta: {
          requiresAuth: true,
          title: 'Update Disaster'
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
        component:AdminCategory,
        meta: {
          requiresAuth: true,
          title: 'Category'
        },
      },
      {
        name:'AdminCreateCategory',
        path: 'category/create',
        component:AdminCreateCategory,
        meta: {
          requiresAuth: true,
          title: 'Create Category'
        },
      },
      {
        name:'AdminUpdateCategory',
        path: 'category/:id',
        component:AdminUpdateCategory,
        meta: {
          requiresAuth: true,
          title: 'Update Category'
        },
      },
      {
        name:'AdminAccount',
        path: 'admin-account',
        component:AdminAccount,
        meta: {
          requiresAuth: true,
          title: 'Admin Account'
        },
      },
      {
        name:'AdminCreateAdmin',
        path: 'admin-account/create',
        component:AdminCreateAdmin,
        meta: {
          requiresAuth: true,
          title: 'Create Admin Account'
        },
      },
      {
        name:'AdminUpdateAdmin',
        path: 'admin-account/:id',
        component:AdminUpdateAdmin,
        meta: {
          requiresAuth: true,
          title: 'Update Admin Account'
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
