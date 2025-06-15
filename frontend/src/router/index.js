import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/LoginView.vue'
import AdminLayout from '../layout/AdminLayout.vue'
import AdminView from '../views/AdminView.vue'
import AyudanteView from '../views/AyudanteView.vue'
import RandomView from '../views/RandomView.vue'
import RegisterView from '@/views/RegisterView.vue'
import VisitorView from '@/views/VisitorView.vue'
import IndexLayout from '@/layout/indexLayout.vue'



const routes = [
  // Login   
      {
        path: '/recicla0te.com/login',
        name: 'login',
        component: LoginView
      },
      {
        path: '/recicla0te.com/register',
        name: 'register',
        component: RegisterView
      },
      

  {
    path: '/recicla0te.com',
    component: IndexLayout,
    children: [
      { path: '', name: 'visitor', component: VisitorView },
      { path: ':pathMatch(.*)*', redirect: { name: 'visitor' } },

    ]

  },

  // Admin con layout
{
  path: '/recicla0te.com/admin',
  component: AdminLayout,
  
  children: [
    { path: '', name: 'admin', component: AdminView },
    { path: 'usuarios', name: 'usuarios', component: AdminView },
    { path: 'reportes', name: 'reportes', component: AdminView },
    { path: 'rand', name: 'random', component: RandomView },
    { path: ':pathMatch(.*)*', redirect: { name: 'admin' } },
  ]
},

// reutilizador 
{
  path: '/recicla0te.com/reutilizador',
  name: 'reutilizador',
  component: AyudanteView,
  children: [
    { path: ':pathMatch(.*)*', redirect: { name: 'reutilizador' } },

  ]
},
{
  path: '/:pathMatch(.*)*',
  name: 'not-found',
  redirect: { name: 'visitor' }
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

  // // Si el usuario ya esta logueado y trata de ir al login, redirigir según su rol
  if ((token && to.name === 'login' ) || (token && to.name === 'register')
      || (token && to.name === 'visitor')) 
  {
      if (role === 'admin') return next({ name: 'admin' })
      // if (role === 'clasificador') return next({ name: 'clasificador' })
      if (role === 'reutilizador') return next({ name: 'reutilizador' })
  }

  
  // Si no hay token y trata de ir a cualquier página que no sea login
  // if (!token){
  //   switch(to.name){
  //     case !'login':
  //         return next({ name: 'login' })
  //       break
  //     case !'register':
  //         return next({ name: 'login' })
  //       break
  //     case !'visitor':
  //         return next({ name: 'login' })
  //       break
  //       default:
  //         return next({name: 'login'})
  //         break
  //   }
    
  //     //  return next({ name: 'login' })
  // }

  // Control por roles
  if (to.name?.startsWith('admin') && role !== 'admin') return next({ name: 'login' })
  if (to.name === 'reutilizador' && role !== 'reutilizador') return next({ name: 'login' })

  next()
})


export default router
