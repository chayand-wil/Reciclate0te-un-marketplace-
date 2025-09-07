<template>
  <header
    class="w-full backdrop-blur-lg bg-white/10 text-white fixed top-0 z-50 border-b border-white/10"
  >
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
      <!-- Logo -->
      <div class="flex items-center space-x-1 ml-4 sm:ml-8 lg:ml-16">
        <!-- <img src="" alt="Logo" class="w-6 h-6" /> -->
        <span class="text-lg font-bold">Reciclate</span>
      </div>

      <!-- Menú centrado -->
      <nav class="flex items-center space-x-6 relative z-50">
        

        <router-link to="/recicla0te.com/clasificador">Home</router-link>
        <router-link to="/recicla0te.com/clasificador/rankin">Ranking</router-link>

        <router-link to="/recicla0te.com/clasificador/nosotros"> Sobre Nosotros </router-link>

        <a href="#" class="flex flex-col items-center text-xm hover:opacity-90"> </a>
      </nav>

      <!-- Apps y Usuario -->
      <div class="flex items-center space-x-4 mr-4 sm:mr-8 lg:mr-16">
    
        <div>
          <router-link to="/recicla0te.com/clasificador/mi_cuenta_clasificador">Mi Cuenta</router-link>
        </div>  

        <button aria-label="Apps" class="hover:opacity-90">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 24 24"
            class="w-6 h-6"
          >
            <circle cx="5" cy="5" r="2" />
            <circle cx="12" cy="5" r="2" />
            <circle cx="19" cy="5" r="2" />
            <circle cx="5" cy="12" r="2" />
            <circle cx="12" cy="12" r="2" />
            <circle cx="19" cy="12" r="2" />
            <circle cx="5" cy="19" r="2" />
            <circle cx="12" cy="19" r="2" />
            <circle cx="19" cy="19" r="2" />
          </svg>
        </button>
        <UserDropdown />
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import UserDropdown from '../UserDropdown.vue'
import router from '@/router'

const isOpen = ref(false)
const dropdownRef = ref(null)

function toggleDropdown() {
  isOpen.value = !isOpen.value
}

// Detectar clic fuera
function handleClickOutside(event) {
  if (dropdownRef.value && !dropdownRef.value.contains(event.target)) {
    isOpen.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>

<style scoped>
header {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
</style>
