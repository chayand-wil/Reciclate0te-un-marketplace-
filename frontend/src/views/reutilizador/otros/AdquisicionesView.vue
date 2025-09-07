<template>
  <h2 class="text-xl font-bold text-white mb-4 text-center">Solicitudes Realizadas</h2>
  <div class="mt-4 mb-10 flex items-center justify-center">
    <!-- Filtros -->
    <div class="flex space-x-4 mb-2 text-white">
      <button
        @click="seleccionarEstado('pendiente')"
        :class="estadoSeleccionado === 'pendiente' ? 'font-bold underline' : ''"
      >
        Pendiente
      </button>
      <button
        @click="seleccionarEstado('aceptada')"
        :class="estadoSeleccionado === 'aceptada' ? 'font-bold underline' : ''"
      >
        Aceptadas
      </button>
      <button
        @click="seleccionarEstado('rechazada')"
        :class="estadoSeleccionado === 'rechazada' ? 'font-bold underline' : ''"
      >
        Rechazadas
      </button>
    </div>
  </div>
  <!-- Lista agrupada por artículo -->
  <div v-for="(grupo, nombreArticulo) in solicitudesAgrupadas" :key="nombreArticulo" class="mb-6">
    <PublicationView :publication="grupo[0].publication" :user="grupo[0].user" />

    <div class="mt-1 mb-10 w-full flex items-center justify-center">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="solicitud in grupo"
          :key="solicitud.id"
          class="bg-gray-800 rounded-lg p-4 shadow-md text-white"
        >
          <p><span class="font-semibold">Usuario:</span> {{ solicitud.user.name }}</p>
          <p><span class="font-semibold">Fecha:</span> {{ formatFecha(solicitud.created_at) }}</p>

          <div class="mt-3">
            <button
              @click="responder(solicitud.id, 'rechazada')"
              class="bg-red-600 px-3 py-1 rounded text-white mr-2"
            >
              Cancelar
            </button>

            <br />
          </div>
        </div>
      </div>

      <br />
      <hr />
    </div>

<!-- Aqui se mostraran los estados -->
    
  </div>
  <!-- Sin resultados -->
  <p v-if="solicitudesFiltradas.length === 0" class="text-center   text-gray-400 mt-4">
    No hay solicitudes en este estado.
  </p>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import api from '../../../axios'
import router from '@/router'
import PublicationView from '@/views/public/PublicationView.vue'

const solicitudes = ref([])
const pubs = ref([]) // Para almacenar publicaciones si es necesario
const estadoSeleccionado = ref('pendiente')
const error = ref('')



// Cargar solicitudes al iniciar
onMounted(async () => {
  try {
    const id_user = localStorage.getItem('id')
    const res = await api.get(`/getSolicitados/${id_user}`)
    solicitudes.value = res.data
    console.log('Solicitudes cargadas:', solicitudes.value)
  } catch (e) {
    if (e.response && e.response.status === 422) {
      const errores = e.response.data.error
      error.value = ' Error ' + Object.values(errores).flat().join(', ')
    }
    console.error(e)
  }
})


// Filtrar por estado
const solicitudesFiltradas = computed(() => {
  return solicitudes.value.filter((s) => s.estado_solicitud?.slug === estadoSeleccionado.value)
})

// Cambiar filtro de estado
function seleccionarEstado(estado) {
  estadoSeleccionado.value = estado
}

// Acción sobre una solicitud
async function responder(idSolicitud, accion) {
  try {
    const res = await api.patch(`/getMisSolicitudes/${idSolicitud}`, {
      accion: accion,
    })

    // Actualizar en la interfaz
    const solicitud = solicitudes.value.find((s) => s.id === idSolicitud)
    if (solicitud) {
      if (accion === 'aceptada') {
        solicitud.estado_solicitud.slug = 'aceptada'
        solicitud.estado_solicitud.nombre = 'Aceptada'
      } else if (accion === 'rechazada') {
        solicitud.estado_solicitud.slug = 'rechazada'
        solicitud.estado_solicitud.nombre = 'Rechazada'
      } else if (accion === 'pendiente') {
        solicitud.estado_solicitud.slug = 'pendiente'
        solicitud.estado_solicitud.nombre = 'Pendiente'
      }
    }
  } catch (e) {
    console.error('Error al actualizar solicitud:', e)
  }
}

const solicitudesAgrupadas = computed(() => {
  const grupos = {}
  solicitudesFiltradas.value.forEach((s) => {
    const nombreArticulo = s.publication.article.nombre
    if (!grupos[nombreArticulo]) {
      grupos[nombreArticulo] = []
    }
    grupos[nombreArticulo].push(s)
  })
  return grupos
})

// Formatear fecha
function formatFecha(fecha) {
  return new Date(fecha).toLocaleDateString('es-ES')
}
</script>
