<template>
  <nav class="SideBar col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
          <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" :href="'/dashboard'">
                      <i class="fa fa-space-shuttle"></i>
                      Dashboard
                  </a>
                  <a class="nav-link active" :href="'/usuario'">
                      <i class="fa fa-user"></i>
                      Listar Usuários
                  </a>
              </li>
          </ul>
      </div>
  </nav>
</template>

<script>
export default {
  name: 'SideBarComponent'
}
</script>
