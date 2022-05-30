import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/Dashboard'
import Disaster from '../components/Disaster'
import AdminDashboard from '../components/Admin/Dashboard'

const routes = [
    {
        path: '/register',
        name: 'Register',
        component: () => import('../components/Register.vue')
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../components/Login.vue')
    },
    {
        path        : '/',
        name        : 'Dashboard',
        component   : Dashboard,
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
            name    : 'Disaster'
        }
    },
    {
        path        : '/product',
        name        : 'Product',
        component   : function () {
            return import('../components/Product')
        }
    },
  {
    path: '/admin',
    name: 'Admin',
    component: function () {
      return import('../views/Admin')
    },
    children:[
      {
        name:'AdminDashboard',
        path: '',
        component:AdminDashboard,
        meta: {
          requiresAuth: true,
        },
      },
      {
        name:'LoginDashboard',
        path: '/login',
        component:AdminDashboard
      },
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
