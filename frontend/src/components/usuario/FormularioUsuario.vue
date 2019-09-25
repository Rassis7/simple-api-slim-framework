<template>
  <div id="formularioUsuario">
    <form>
        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" v-model="usuario.nome" class="form-control" placeholder="Nome">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" v-model="usuario.email" disabled="disabled" class="form-control" placeholder="Email">
        </div>
      <button type="button" class="btn btn-primary" v-bind:disabled="!isValid" @click="updateUser(usuario)">Salvar</button>
    </form>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import ls from 'localStorage'

export default {
  name: 'formularioUsuario',
  data () {
    return {
      usuario: {
        id: null,
        nome: null,
        email: null
      },
      isUsuarioLogado: null
    }
  },
  computed: {
    ...mapGetters(['getUser']),
    isValid () {
      return this.usuario.nome !== ''
    }
  },
  methods: {
    ...mapActions(['findById', 'update']),
    updateUser (usuario) {
      this.update(usuario)
        .then(() => {
          this.usuario.nome = this.getUser.nome
          this.usuario.email = this.getUser.email
          this.$toast.bottom('Usuário salvo')
        })
        .then(() => {
          this.$router.push('/usuario')
        })
        .catch(() => {
          this.$toast.bottom('Usuário não salvo')
        })
    }
  },
  mounted () {
    const id = parseInt(this.$route.params.id)
    this.isUsuarioLogado = ls.getItem('ul') !== null || ls.getItem('ul') !== '' || ls.getItem('ul') !== 'undefined'
    if (!isNaN(id)) {
      this.findById({id: id})
        .then(() => {
          this.usuario.id = this.$route.params.id
          this.usuario.nome = this.getUser.nome
          this.usuario.email = this.getUser.email
        })
        .catch(() => {
          console.err('Erro ao buscar o usuário')
        })
    }
  }
}
</script>
