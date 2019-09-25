import Vue from 'vue'
import Router from 'vue-router'
import Guard from '@/services/middleware'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'login',
      component: function (resolve) {
        require(['@/components/Login.vue'], resolve)
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: function (resolve) {
        require(['@/components/Dashboard.vue'], resolve)
      },
      beforeEnter: Guard.auth
    },
    {
      path: '/usuario',
      name: 'usuarioListar',
      component: function (resolve) {
        require(['@/components/usuario/ListarUsuario.vue'], resolve)
      },
      beforeEnter: Guard.auth
    },
    {
      path: '/usuario/:id',
      name: 'usuarioForm',
      component: function (resolve) {
        require(['@/components/usuario/FormularioUsuario.vue'], resolve)
      },
      beforeEnter: Guard.auth
    },
    {
      path: '*',
      component: function (resolve) {
        require(['@/components/Error404.vue'], resolve)
      },
      beforeEnter: Guard.auth
    }
  ]
})

export default router
