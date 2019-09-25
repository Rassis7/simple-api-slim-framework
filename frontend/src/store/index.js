import Authorization from './modules/Authorization'
import Usuario from './modules/Usuario'
import Nasa from './modules/Nasa'

import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'prod'

export default new Vuex.Store({
  modules: {
    Authorization: Authorization,
    Usuario: Usuario,
    Nasa: Nasa
  },
  strict: debug
})
