import { createRouter, createWebHistory } from 'vue-router'
import Dashboard from '../views/Dashboard.vue'
import Disaster from '../components/Disaster'

const routes = [
  {
    path: '/',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/disaster',
    name: 'Disaster',
    component: Disaster
  },
  {
    path: '/product',
    name: 'Product',
    component: function () {
      return import('../components/Product.vue')
    }
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
