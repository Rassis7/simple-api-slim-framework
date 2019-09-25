import {HTTP_AXIOS} from '../../../config/http-axios'

const state = {
  tokenAuth: null,
  userLogado: null
}

const getters = {
  getTokenAuth: state => state.tokenAuth,
  getTUserLogado: state => state.userLogado
}

const actions = {
  async logar ({commit}, param) {
    const res = await HTTP_AXIOS.post('/auth', param)
    commit('TOKEN_AUTH', res.data)
  }
}

const mutations = {
  TOKEN_AUTH (state, response) {
    state.tokenAuth = response
  },
  ADD_USER_LOGADO (state, response) {
    state.userLogado = response
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
