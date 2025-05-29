<template>
  <div ref="menuRef" class="user-menu">
    <!-- Botón de apertura -->
    <button class="icon-button" @click.stop="toggle">👤</button>

    <!-- Menú desplegable -->
    <div v-if="open" class="dropdown">
      <p><strong>{{ user.name }}</strong></p>
      <p>{{ user.email }}</p>
      <button @click="logout">Cerrar sesión</button>
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import api from '../axios'
import { useRouter } from 'vue-router'

const router = useRouter()
const open = ref(false)
const user = ref({ name: '', email: '' })
const menuRef = ref(null)

const toggle = () => {
  open.value = !open.value
}

const handleClickOutside = (e) => {
  if (menuRef.value && !menuRef.value.contains(e.target)) {
    open.value = false
  }
}

onMounted(async () => {
  document.addEventListener('click', handleClickOutside)
  try {
    const res = await api.get('/me')
    user.value = res.data
  } catch {
    router.push('/')
  }
})

onBeforeUnmount(() => {
  document.removeEventListener('click', handleClickOutside)
})

const logout = async () => {
  try {
    await api.post('/logout')
  } catch {}
  localStorage.clear()
  router.push('/')
}
</script>

<style scoped>
.user-menu {
  position: relative;
}

.icon-button {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}

.dropdown {
  position: absolute;
  top: 2rem;
  right: 0;
  background: white;
  border: 1px solid #ccc;
  padding: 1rem;
  color: #333;
  width: 200px;
  z-index: 100;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
</style>

