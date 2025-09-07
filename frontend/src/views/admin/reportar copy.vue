<template>
  <h1>Reportes</h1>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRoute } from 'vue-router'

const error = ref('')

const user = ref('')
const id_user = ref('')

const usuarios = ref('')
const publicaciones = ref('')

const route = useRoute()

onMounted(async () => {
  try {
    //carga de datos
    const res1 = await api.get('/getUserAllFields')
    usuarios.value = res1.data

    const res2 = await api.get('/publications')
    publicaciones.value = res2.data

    console.log(usuarios.value)
    console.log(publicaciones.value)
  } catch (e) {
    console.error(e)
    error.value = 'Error al cargar datos del perfil'
  }
})
</script>
