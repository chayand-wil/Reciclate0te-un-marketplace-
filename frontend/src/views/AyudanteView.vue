<template>
  <h2>Ayuddd</h2>
  <button @click="logout">Cerrar sesión</button>
</template>

<script setup>
import { onMounted } from 'vue'
import api from '../axios'
import { useRouter } from 'vue-router'

const router = useRouter()

// Verifica el rol al entrar
onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.role !== 'ayudante') {
      router.push('/')
    }
  } catch (e) {
    router.push('/')
  }
})

// Función para cerrar sesión
const logout = async () => {
  try {
    await api.post('/logout') // <- cierra la sesión en Laravel
  } catch (e) {
    // incluso si falla, limpiamos localStorage
  }

  localStorage.removeItem('token')
  localStorage.removeItem('role')
  router.push('/')
}
</script>

