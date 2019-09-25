// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
/* eslint-disable no-new */
import Vue from 'vue'
import App from './App'
import router from './router'
import BootstrapVue from 'bootstrap-vue'

import css from '../src/assets/css/style.css'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import store from './store'

import FBSignInButton from 'vue-facebook-signin-button'
import GSignInButton from 'vue-google-signin-button'

import 'vue2-toast/lib/toast.css'
import Toast from 'vue2-toast'

Vue.use(Toast)
Vue.use(GSignInButton)
Vue.use(FBSignInButton)
Vue.use(BootstrapVue)

Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  css,
  store,
  components: { App },
  template: '<App/>'
})
