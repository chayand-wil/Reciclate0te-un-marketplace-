import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/LoginView.vue'
import AdminLayout from '../layout/AdminLayout.vue'
import AdminView from '../views/AdminView.vue'
import AyudanteView from '../views/AyudanteView.vue'
import RandomView from '../views/RandomView.vue'
import OtraView from '../views/OtraView.vue'



const routes = [
  // Login   
  {
    path: '/',
    name: 'login',
    component: LoginView
  },

  // Admin con layout
{
  path: '/admin',
  component: AdminLayout,
  
  children: [
    { path: '', name: 'admin', component: AdminView },
    { path: 'usuarios', name: 'usuarios', component: AdminView },
    { path: 'reportes', name: 'reportes', component: AdminView },
    { path: 'rand', name: 'random', component: RandomView },
    { path: 'otra', name: 'otra', component: OtraView },
  ]
},

  // Ayudante  
  {
    path: '/ayudante',
    name: 'ayudante',
    component: AyudanteView
  }
]



  



const router = createRouter({
  history: createWebHistory(),
  routes
})

// Middleware de autenticación
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  const role = localStorage.getItem('role')

  // Si el usuario ya está logueado y trata de ir al login, redirigir según su rol
  if (token && to.name === 'login') {
    if (role === 'admin') return next({ name: 'admin' })
    if (role === 'ayudante') return next({ name: 'ayudante' })
  }

  // Si no hay token y trata de ir a cualquier página que no sea login
  if (!token && to.name !== 'login') {
    return next({ name: 'login' })
  }

  // Control por roles
  if (to.name?.startsWith('admin') && role !== 'admin') return next({ name: 'login' })
  if (to.name === 'ayudante' && role !== 'ayudante') return next({ name: 'login' })

  next()
})


export default router
