<template>
  <aside class="sidebar">
    <ul>
      <li><router-link to="/recicla0te.com/admin">Inicio</router-link></li>
      <li><router-link to="/recicla0te.com/admin/usuarios">Usuarios</router-link></li>
      <li><router-link to="/recicla0te.com/admin/reportes">Reportes</router-link></li>
      <li><router-link to="/recicla0te.com/admin/rand">Reportes</router-link></li>
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
    background: rgba(0, 54, 32, 0.558); /* Para modo oscuro */
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
