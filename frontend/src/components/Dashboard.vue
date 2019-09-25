<template>
  <div id="dashboard">
    <div class="form-group col-md-12">
      <label>Selecione um asteroide</label>
      <select v-model="selected" class="col-md-5 form-control" @change="verAsteroid">
        <option disabled="disabled" value="">--Selecione--</option>
        <option v-for="option in options" :disabled="option.disabled" v-bind:value="option.value" v-bind:key="option.value">
        {{ option.text }}
        </option>
      </select>
    </div>
    <br>
    <div v-if="asteroidInfos !== null" class="row">
      <div class="col-md-2">
        <strong>
        <a :href="asteroidInfos.url" target="_blank">Sobre o asteroide</a>
        </strong>
      </div>

      <div class="col-md-6">
        É perigoso para a Terra?
        <strong v-if="asteroidInfos.perigoso === true">SIM</strong>
        <strong v-else>NÃO</strong>
      </div>

      <br>
      <br>

      <div class="col-md-12">
        <h2>Diâmetro</h2>

        <div class="col-md-6">
          <span>
            Máximo(m): <strong>{{asteroidInfos.diametro.max | truncate}}</strong>
          </span>
        </div>

        <div class="col-md-6">
          <span>
            Mínimo(m): <strong>{{asteroidInfos.diametro.min | truncate}}</strong>
          </span>
        </div>

      </div>

    </div>

  </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
  name: 'DashboardComponent',
  data () {
    return {
      selected: '',
      options: [],
      asteroidInfos: null
    }
  },
  computed: {
    ...mapGetters(['getAllDataAsteroids', 'getOneDataAsteroid'])
  },
  filters: {
    truncate: function (value) {
      return value.toFixed(2)
    }
  },
  methods: {
    ...mapActions(['findAllAsteroids', 'findByIdAsteroids']),
    verAsteroid (params) {
      const idAsteroid = parseInt(params.srcElement.value)
      if (isNaN(idAsteroid)) {
        this.$toast.bottom('Erro ao se comunicar com a NASA')
        return false
      }

      const self = this
      self.findByIdAsteroids(idAsteroid)
        .then(() => {
          self.asteroidInfos = self.getOneDataAsteroid
        })
    }
  },
  mounted () {
    const self = this
    self.findAllAsteroids()
      .then((r) => {
        (self.getAllDataAsteroids).map(itens => {
          (itens.subItens).map(s => {
            self.options.push({text: `Nome: ${s.nome} - Magnitude: ${s.magnitude}`, value: s.id})
          })
        })
      })
      .catch(e => {
        this.$toast.bottom('Erro ao se comunicar com a NASA')
        console.log(e)
      })
  }
}
</script>
