import axios from 'axios'
import moment from 'moment'

const state = {
  listDataAsteroids: [],
  listOneAsteroid: {}
}

const getters = {
  getAllDataAsteroids: state => state.listDataAsteroids,
  getOneDataAsteroid: state => state.listOneAsteroid
}

const actions = {
  async findByIdAsteroids ({commit}, id) {
    const res = await axios.get(`https://api.nasa.gov/neo/rest/v1/neo/${id}?api_key=${process.env.KEY_ID_NASA}`)
    commit('ADD_ITEM_ASTEROID', res.data)
  },
  async findAllAsteroids ({commit}) {
    const dateIni = moment().format('YYYY-MM-DD')
    const dateFim = moment().add(7, 'days').format('YYYY-MM-DD')
    const res = await axios.get(`https://api.nasa.gov/neo/rest/v1/feed?start_date=${dateIni}&end_date=${dateFim}&api_key=${process.env.KEY_ID_NASA}`)
    commit('ADD_ITENS_LIST_ASTEROIDS', res.data)
  }
}

const mutations = {
  ADD_ITENS_LIST_ASTEROIDS (state, response) {
    let arrayResponse = []
    // Converter o objeto em array
    let earthObjects = response.near_earth_objects
    const earthObjectsArray = Object.keys(earthObjects).map(k => earthObjects[k])

    earthObjectsArray.map((item, index) => {
      let arrayAuxiliarSubItem = []
      item.map(subItem => {
        arrayAuxiliarSubItem.push({
          'id': subItem.neo_reference_id,
          'nome': subItem.name,
          'magnitude': subItem.absolute_magnitude_h
        })
      })
      arrayResponse.push({
        'date': moment(Object.keys(earthObjects)[index]).format('DD/MM/YYYY'),
        'subItens': arrayAuxiliarSubItem
      })
    })
    state.listDataAsteroids = arrayResponse
  },
  ADD_ITEM_ASTEROID (state, response) {
    let objAux = {
      url: response.nasa_jpl_url,
      perigoso: response.is_potentially_hazardous_asteroid,
      diametro: {
        max: response.estimated_diameter.meters.estimated_diameter_max,
        min: response.estimated_diameter.meters.estimated_diameter_min
      }
    }
    state.listOneAsteroid = objAux
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
