<template>
  <h2 class="text-xl font-bold text-white mb-4 text-center">Articulos Adquiridos</h2>
 
  <!-- Lista agrupada por artículo -->
  <div v-for="articulo in articulos" :key="articulo.id" class="mb-6">
    <PublicationView :publication="articulo.publication" :user="articulo.user" />

    <div class="mt-1 mb-10 w-full flex items-center justify-center">
       <!-- <button @click="cargarPublications" class="bg-blue-600 px-4 py-2 rounded text-white">
         Cargar más publicaciones
       </button>

      <br />
      <hr /> -->
    </div>
  </div>
  <!-- Sin resultados -->
  <p v-if="articulos.length === 0" class="text-center text-gray-400 mt-4">
    No hay articulos en este estado.
  </p>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import api from '../../../axios'
import router from '@/router'
import PublicationView from '@/views/public/PublicationView.vue'

const articulos = ref([])
const pubs = ref([]) // Para almacenar publicaciones si es necesario
const error = ref('')

// Cargar articulos al iniciar
onMounted(async () => {
  try {
    const id_user = localStorage.getItem('id')
    const res = await api.get(`/articulos_adquiridos/${id_user}`)
    articulos.value = res.data
    console.log(articulos.value.publication)
  }  catch (e) {
    const res = e.response

    if (res && res.status === 422) {
      const errores = res.data.errors
      error.value = 'Error: ' + Object.values(errores).flat().join(', ')
    } else {
      error.value = res?.data?.error || 'Error inesperado'
      mensaje.value = res?.data?.message || ''
    }

    setTimeout(() => {
      error.value = ''
    }, 5000)

    console.error(e)
  }
})

 
// Cambiar filtro de estado
function seleccionarEstado(estado) {
  estadoSeleccionado.value = estado
}

 

// Formatear fecha
function formatFecha(fecha) {
  return new Date(fecha).toLocaleDateString('es-ES')
}
</script>
