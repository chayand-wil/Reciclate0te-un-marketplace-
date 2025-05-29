<template>
  <aside class="sidebar">
    <ul>
      <li><router-link to="/admin">Inicio</router-link></li>
      <li><router-link to="/admin/usuarios">Usuarios</router-link></li>
      <li><router-link to="/admin/reportes">Reportes</router-link></li>
      <li><router-link to="/admin/rand">Reportes</router-link></li>
      <li><router-link to="/admin/otra">otra</router-link></li>
    </ul>
  </aside>
</template>



<style scoped>
.sidebar {
  width: 220px;
  height: 100%;
  background-color: transparent;
  color: white;
  padding: 1rem;
  box-sizing: border-box;
  margin: 0;
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);  

}
@media (prefers-color-scheme: dark) {
  .sidebar {
    background: rgba(1, 3, 116, 0.558); /* Para modo oscuro */
  }
}


ul {
  list-style: none;
  padding: 0;
}

li {
  margin-bottom: 1rem;
}

a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}

.router-link-exact-active {
  color: #3cffa7;
}
</style>
