import { HTTP_AXIOS } from '../../../config/http-axios'

const state = {
  users: [],
  user: null
}

const getters = {
  getAllUser: state => state.users,
  getUser: state => state.user
}

const actions = {
  async findAll ({ commit }) {
    const res = await HTTP_AXIOS.get('/user/')
    commit('ADD_USERS', res.data)
  },
  async findById ({ commit }, param) {
    const res = await HTTP_AXIOS.get('/user/' + param.id)
    commit('ADD_USER', res.data)
  },
  async update ({ commit }, param) {
    const res = await HTTP_AXIOS.put('/user/' + param.id, param)
    commit('CLEAR_USER', res.data)
  },
  async delete ({ commit }, id) {
    const res = await HTTP_AXIOS.delete('/user/' + id)
    commit('ADD_USER', res)
  },
  async create ({ commit }, params) {
    let payload = {
      name: params.name,
      email: params.email,
      password: params.passwordRS || params.password
    }
    const res = await HTTP_AXIOS.post('/user/', payload)
    return res
  }
}

const mutations = {
  ADD_USERS (state, response) {
    response.map(e => state.users.push(e))
  },
  ADD_USER (state, response) {
    state.user = response
  },
  REMOVE_USER (state, response) {
    state.users = (state.users).filter(e => e.id !== response.id)
  },
  CLEAR_USER (state, response) {
    state.users = []
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
