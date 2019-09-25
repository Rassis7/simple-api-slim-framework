<template>
    <div id="app">
        <nav-bar v-if="($route.fullPath !== '/')"/>
        <div class="container-fluid">
            <div class="row">
                <side-bar v-if="($route.fullPath !== '/')"/>
                <div v-if="($route.fullPath !== '/')" class="col-md-10 content">
                    <router-view/>
                </div>
                <div v-else class="col-md-12 content">
                    <router-view/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from '@/components/layout/NavBar'
import SideBar from '@/components/layout/SideBar'

export default {
  name: 'App',
  components: {
    NavBar,
    SideBar
  }
}

</script>
