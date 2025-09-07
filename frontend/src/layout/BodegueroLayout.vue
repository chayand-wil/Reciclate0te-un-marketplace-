<template>
  <div class="layout">
    <AppHeader />
    <div class="main mt-20" >
      <!-- <AppSidebar /> -->
      <div class="content">
        
        <router-view />
      </div>
    </div>
  </div>
</template>


<script setup>  
import AppHeader from '../components/bodeguero/AppHeader.vue'
// import AppSidebar from '../components/reutilizador/AppSidebar.vue'

import { provide, ref, onMounted } from 'vue' 
import api from '../axios'
import { useRouter } from 'vue-router' 

// Usuario ref for passing to PublicationView
const usuario = ref(null)
const router = useRouter() 
 
onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'bodeguero') {
      router.push('/')
    } else {
      usuario.value = res.data
    }
  } catch (e) {
    router.push('/')
  }
})


provide('usuarioLogueado', usuario)
 

</script>


<style scoped>
.layout {
  display: flex;
  flex-direction: column;
  height: 100vh;
  width: 100%; /* no uses 100vw */
  overflow: hidden;
   
}

.main {
  display: flex;
  flex: 1;
  width: 100%;
  overflow: hidden;
  min-width: 0;
}

.content {
 
  justify-content: center;
  align-items: flex-start;
  width: 100%;
  height: 100%;
  overflow: auto;
  color: rgb(0, 0, 0);
}




</style>
