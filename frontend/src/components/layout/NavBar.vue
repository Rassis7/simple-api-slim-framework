<template>
  <nav class="NavBar navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a
      class="navbar-brand col-sm-3 col-md-2 mr-0"
      href="javascript:void(0)"
    >
      Simple API Slim Framework
    </a>
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a
          class="btn nav-link"
          @click="logout()"
        >Sair</a>
      </li>
    </ul>
  </nav>
</template>

<script>
import ls from 'localStorage'

export default {
  name: 'NavBarComponent',
  data () {
    return {}
  },
  methods: {
    logout () {
      ls.removeItem('TOKEN')
      this.$router.push('/')
    }
  }
}
</script>
<style>
.nav-link {
  cursor: pointer;
}
</style>
