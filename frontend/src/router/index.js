import { createRouter, createWebHistory } from 'vue-router'

import LoginView from '../views/public/LoginView.vue'
import AdminLayout from '../layout/AdminLayout.vue'
import AdminView from '../views/admin/AdminView.vue'
import VisitorView from '@/views/VisitorView.vue'
import IndexLayout from '@/layout/indexLayout.vue'
import ReutilizadorLayout from '@/layout/ReutilizadorLayout.vue'
import NewPublicationView from '@/views/reutilizador/NewPublicationView.vue'
import NosotrosView from '@/views/public/NosotrosView.vue'
import EcoempView from '@/views/public/EcoempView.vue'
import HomeView from '@/views/public/HomeView.vue'
import RegisterView from '@/views/public/RegisterView.vue'
import RankingView from '@/views/public/RankingView.vue'
import AdquisicionesView from '@/views/reutilizador/otros/AdquisicionesView.vue'
import SolicitudesView from '@/views/reutilizador/otros/SolicitudesView.vue'
import PublicationView from '@/views/public/PublicationView.vue'
import InfoUserView from '@/views/public/InfoUserView.vue'
import DetallePublicationLayoutView from '@/layout/DetallePublicationLayoutView.vue'
import MiCuentaLayoutView from '@/layout/MiCuentaLayoutView copy.vue'
import MisPubsView from '@/views/reutilizador/otros/MisPubsView.vue'
import MisArticulos from '@/views/reutilizador/otros/MisArticulos.vue'
import ClasificadorLayout from '@/layout/ClasificadorLayout.vue'
import ClasificadorView from '@/views/clasificador/ClasificadorView.vue'
import BodegueroView from '@/views/bodeguero/BodegueroView.vue'
import BodegueroLayout from '@/layout/BodegueroLayout.vue'
import DetalleView from '@/views/bodeguero/DetalleView.vue'
import Otro from '@/views/reutilizador/otros/otro.vue'
import Listar from '@/views/admin/Listar.vue'
import Reportar from '@/views/admin/reportar.vue'
import DetatalleUser from '@/views/admin/DetatalleUser.vue'
import AllDenuncias from '@/views/admin/AllDenuncias.vue'
// import jwtDecode from 'jwt-decode'

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
      { path: 'usuarios', name: 'usuarios', component: Listar },
      { path: 'detalle_user/:id', name: 'detalle_user', component: DetatalleUser },
      { path: 'all_denuncias', name: 'all_denuncias', component: AllDenuncias },
      { path: 'reportes', name: 'reportes', component: Reportar },
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
      { path: 'otro', name: 'otro', component: Otro },
      {
        path: 'pub/:id/',
        component: DetallePublicationLayoutView,
        children: [
          { path: '', name: 'pub', component: PublicationView, props: true },
          { path: 'info_user', name: 'info_user', component: InfoUserView, props: true },
        ],
      },
      {
        path: 'mi_cuenta',
        component: MiCuentaLayoutView,
        children: [
          { path: '', name: 'mi_cuenta', component: InfoUserView },
          { path: 'solicitudes', name: 'solicitudes', component: AdquisicionesView },
          { path: 'bandeja', name: 'bandeja', component: SolicitudesView },
          { path: 'mis_pubs', name: 'mis_pubs', component: MisPubsView },
          { path: 'mis_articulos', name: 'mis_articulos', component: MisArticulos },
        ],
      },
      { path: ':pathMatch(.*)*', redirect: { name: 'reutilizador' } },
    ],
  },
  {
    path: '/recicla0te.com/clasificador',
    component: ClasificadorLayout,
    children: [
      { path: '', name: 'clasificador', component: ClasificadorView },
      { path: 'ranking', name: 'ranking', component: RankingView },
      { path: 'nosotross', name: 'nosotross', component: NosotrosView },
      { path: 'mi_cuenta_clasificador', name: 'mi_cuenta_clasificador', component: InfoUserView },
    ],
  },
  {
    path: '/recicla0te.com/bodeguero',
    component: BodegueroLayout,
    children: [
      { path: '', name: 'bodeguero', component: BodegueroView },
      { path: 'mi_cuenta_bodeguero/', name: 'mi_cuenta_bodeguero', component: InfoUserView },
      {
        path: 'detalle_intercambio/:id',
        name: 'detalle_intercambio',
        component: DetalleView,
        props: true,
      },
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
    if (role === 'clasificador') return next({ name: 'clasificador' })
    if (role === 'bodeguero') return next({ name: 'bodeguero' })
  }

  // Control por roles
  if (to.name?.startsWith('admin') && role !== 'admin') return next({ name: 'login' })
  if (to.name === 'reutilizador' && role !== 'reutilizador') return next({ name: 'login' })

  next()
})

export default router
