import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/public/LoginView.vue'
import AdminLayout from '../layout/AdminLayout.vue'
import AdminView from '../views/admin/AdminView.vue'
import RandomView from '../views/RandomView.vue'
import VisitorView from '@/views/VisitorView.vue'
import IndexLayout from '@/layout/indexLayout.vue'
import ReutilizadorLayout from '@/layout/ReutilizadorLayout.vue'
import NewPublicationView from '@/views/reutilizador/NewPublicationView.vue'
import NosotrosView from '@/views/public/NosotrosView.vue'
import EcoempView from '@/views/public/EcoempView.vue'
import HomeView from '@/views/public/HomeView.vue'
import RegisterView from '@/views/public/RegisterView.vue'
import RankingView from '@/views/public/RankingView.vue'
import MiPerfilView from '@/views/reutilizador/otros/MiPerfilView.vue'
import AdquisicionesView from '@/views/reutilizador/otros/AdquisicionesView.vue'
import SolicitudesView from '@/views/reutilizador/otros/SolicitudesView.vue'
import PublicationView from '@/views/public/PublicationView.vue'
import InfoUserView from '@/views/public/InfoUserView.vue'
import DetallePublicationLayoutView from '@/layout/DetallePublicationLayoutView.vue'
import MiCuentaLayoutView from '@/layout/MiCuentaLayoutView copy.vue'

const routes = [
  // Login
  {
    path: '/recicla0te.com/login',
    name: 'login',
    component: LoginView,
  },
  {
    path: '/recicla0te.com/register',
    name: 'register',
    component: RegisterView,
  },
  {
    path: '/recicla0te.com/nosotros',
    name: 'nosotros',
    component: RegisterView,
  },

  {
    path: '/recicla0te.com',
    component: IndexLayout,
    children: [
      { path: '', name: 'visitor', component: VisitorView },
      { path: ':pathMatch(.*)*', redirect: { name: 'visitor' } },
    ],
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
    ],
  },

  // reutilizador
  {
    path: '/recicla0te.com/reutilizador',
    component: ReutilizadorLayout,
    children: [
      { path: '', name: 'reutilizador', component: HomeView },
      { path: 'nosotros', name: 'nosotros', component: NosotrosView },
      { path: 'ranking', name: 'ranking', component: RankingView },
      { path: 'ecoemp', name: 'ecoemp', component: EcoempView },
      { path: 'publicar', name: 'publicar', component: NewPublicationView },
      {
        path: 'pub',
        component: DetallePublicationLayoutView,
        children: [
          { path: '', name: 'pub', component: PublicationView },
          { path: 'info_user', name: 'info_user', component: InfoUserView },
        ],
      },
      {
        path: 'mi_cuenta',
        component: MiCuentaLayoutView,
        children: [
          { path: '', name: 'mi_cuenta', component: MiPerfilView },
          { path: 'adquisiciones', name: 'adquisiciones', component: AdquisicionesView },
          { path: 'solicitudes', name: 'solicitudes', component: SolicitudesView },
        ],
      },

      { path: ':pathMatch(.*)*', redirect: { name: 'reutilizador' } },
    ],
  },

  //nada -  captura de rutas no encontradas
  {
    path: '/:pathMatch(.*)*',
    name: 'not-found',
    redirect: { name: 'visitor' },
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Middleware de autenticación
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token')
  const role = localStorage.getItem('role')

  // // Si el usuario ya esta logueado y trata de ir al login, redirigir según su rol
  if (
    (token && to.name === 'login') ||
    (token && to.name === 'register') ||
    (token && to.name === 'visitor')
  ) {
    if (role === 'admin') return next({ name: 'admin' })
    if (role === 'reutilizador') return next({ name: 'reutilizador' })
  }

  // Control por roles
  if (to.name?.startsWith('admin') && role !== 'admin') return next({ name: 'login' })
  if (to.name === 'reutilizador' && role !== 'reutilizador') return next({ name: 'login' })

  next()
})

export default router
