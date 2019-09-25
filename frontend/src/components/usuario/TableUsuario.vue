<template>
  <div id="tableUser">
    <table class="table table-hover col-xs-12">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Email</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="u in usuarios" :key="u.id">
          <td>{{ u.nome }}</td>
          <td>{{ u.email }}</td>
          <td>
            <button type="button" class="btn btn-primary" @click="goTo('/usuario/' + u.id)">Editar</button>
            <button  v-if="u.email != email" type="button" class="btn btn-danger" v-b-modal.modalConfirm @click="itemToDelete=u">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>

      <!--Modal-->
      <div>
        <b-modal id="modalConfirm" @ok="delUser(itemToDelete)" cancel-title="Fechar" ok-title="Sim, desejo" title="Deseja realmente excluir o usuário?"></b-modal>
      </div>

    </div>
</template>

<script>
import ls from 'localStorage'

export default {
  name: 'tableUser',
  props: ['usuarios'],
  data () {
    return {
      email: null
    }
  },
  methods: {
    goTo (url) {
      this.$router.push(url)
    },
    delUser (user) {
      this.$emit('del', user)
    }
  },
  mounted () {
    this.email = ls.getItem('ul')
  }
}
</script>
