import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import UsersView from '../views/UsersView.vue'
import UserView from '../views/UserView.vue'
import UsersCreateView from '../views/UsersCreateView.vue'
import UsersEditView from '../views/UsersEditView.vue'
import ProductView from '../views/ProductView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue')
    },
    
    {
      path: '/users',
      name: 'users',
      component: UsersView
    },
    {
      path: '/users/:id',
      name: 'user',
      component: UserView
    },
    {
      path: '/users/create',
      name: 'users-create',
      component: UsersCreateView
    },
    {
      path: '/users/edit/:id',
      name: 'users-edit',
      component: UsersEditView
    },
    {
      path: '/products/:id',
      name: 'product',
      component: ProductView
    },
  ]
})

export default router
