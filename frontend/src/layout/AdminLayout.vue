<template>
  <div class="layout">
    <AppHeader />
    <div class="main">
      <AppSidebar />
      <div class="content">
        <router-view />
      </div>
    </div>
  </div>
</template>

<script setup>
import AppHeader from '../components/AppHeader.vue'
import AppSidebar from '../components/AppSidebar.vue'
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
  display: grid;
  place-items: center;
  height: 100%;
  width: 100%;
  overflow: auto;
  color: white; 
}




</style>
