<template>
  <div id="usuarioListar">
    <h2>Listagem de usuários</h2>
    <table-usuario v-bind:usuarios="users" v-on:del="deleteUsuario"></table-usuario>

  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import TableUsuario from '@/components/usuario/TableUsuario'

export default {
  name: 'usuarioListar',
  components: { TableUsuario },
  data () {
    return {
      users: this.getAllUser
    }
  },
  methods: {
    ...mapActions(['findAll', 'delete']),
    ...mapMutations({
      removeUser: 'REMOVE_USER'
    }),
    listAll () {
      return this.findAll()
        .then(() => {
          this.users = this.getAllUser
        })
        .catch(() => {
          console.log('oajs')
          this.$toast.bottom('Erro ao listar os usuarios')
        })
    },
    deleteUsuario (user) {
      this.delete(user.id)
        .then(() => {
          this.removeUser(user)
          this.users = this.getAllUser
        })
        .then(() => {
          this.$toast.bottom('Usuário excluído')
        })
        .catch(() => {
          this.$toast.bottom('Erro ao excluir o usuario')
        })
    }
  },
  computed: {
    ...mapGetters(['getAllUser'])
  },
  mounted () {
    this.listAll()
  }
}
</script>
