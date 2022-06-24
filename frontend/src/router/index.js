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
      component:AdminLogin,
      meta: {
        requiresAuth: false,
      },
    },
    {
      name:'AdminDashboard',
      path: '',
      component:AdminDashboard,
      meta: {
        requiresAuth: true,
        title: 'Beranda'
      },
    },
    {
      name:'AdminDisaster',
      path: 'disaster',
      component:AdminDisaster,
      meta: {
        requiresAuth: true,
        title: 'Bencana'
      },
    },
    {
      name:'AdminCreateDisaster',
      path: 'disaster/create',
      component:AdminCreateDisaster,
      meta: {
        requiresAuth: true,
        title: 'Tambah Bencana'
      },
    },
    {
      name:'AdminUpdateDisaster',
      path: 'disaster/:id',
      component:AdminUpdateDisaster,
      meta: {
        requiresAuth: true,
        title: 'Perbarui Bencana'
      },
    },
    {
      name:'AdminUser',
      path: 'user',
      component:AdminUser,
      meta: {
        requiresAuth: true,
        title: 'Pengguna'
      },
    },
    {
      name:'AdminCreateUser',
      path: 'user/create',
      component:AdminCreateDisaster,
      meta: {
        requiresAuth: true,
        title: 'Tambah Pengguna'
      },
    },
    {
      name:'AdminProducts',
      path: 'products',
      component:AdminProducts,
      meta: {
        requiresAuth: true,
        title: 'Barang'
      },
    },
    {
      name:'AdminCategory',
      path: 'category',
      component:AdminCategory,
      meta: {
        requiresAuth: true,
        title: 'Kategori'
      },
    },
    {
      name:'AdminCreateCategory',
      path: 'category/create',
      component:AdminCreateCategory,
      meta: {
        requiresAuth: true,
        title: 'Tambah Kategori'
      },
    },
    {
      name:'AdminUpdateCategory',
      path: 'category/:id',
      component:AdminUpdateCategory,
      meta: {
        requiresAuth: true,
        title: 'Perbarui Kategori'
      },
    },
    {
      name:'AdminAccount',
      path: 'admin-account',
      component:AdminAccount,
      meta: {
        requiresAuth: true,
        title: 'Akun Admin'
      },
    },
    {
      name:'AdminCreateAdmin',
      path: 'admin-account/create',
      component:AdminCreateAdmin,
      meta: {
        requiresAuth: true,
        title: 'Tambah Akun Admin'
      },
    },
    {
      name:'AdminUpdateAdmin',
      path: 'admin-account/:id',
      component:AdminUpdateAdmin,
      meta: {
        requiresAuth: true,
        title: 'Perbarui Akun Admin'
      },
    },
    {
      name: 'ReportDisaster',
      path: 'report-disaster',
      component   : function () {
        return import('../views/Admin/ReportDisaster')
      },
      meta: {
        requiresAuth: true,
        title: 'Laporan Bencana'
      }
    },
    {
      name: 'ReportProduct',
      path: 'report-product',
      component   : function () {
        return import('../views/Admin/ReportProducts')
      },
      meta: {
        requiresAuth: true,
        title: 'Laporan Barang'
      }
    }]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach(async (to, from, next) => {
  let isAuthenticated = localStorage.getItem('token-admin')
  if (to.meta.requiresAuth && to.name !== 'AdminLogin' && !isAuthenticated){
    next({ name: 'AdminLogin' })
  } else if(to.name == 'AdminLogin' && isAuthenticated) {
    next({ name: 'AdminDashboard' })
  }else{
    next() 
  }
})

export default router
