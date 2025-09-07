<template>
  <div
    class="w-full mt-20 mb-40 text-black max-w-4xl bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg mb-6"
  >
    <h2 class="text-xl font-bold mb-4">Filtrar por estado de denuncia:</h2>
    <select v-model="estadoSeleccionado" class="border px-2 py-1 rounded mb-6">
      <option value="">Todos</option>
      <option value="pendiente">Sin revisión</option>
      <option value="revisado">Revisado</option>
      <option value="rechazado">Rechazado</option>
    </select>

    <h3 class="text-lg font-semibold mt-6 mb-2">🔹 Denuncias a Usuarios</h3>
    <table class="min-w-full border mb-10">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-2 py-1">ID</th>
          <th class="border px-2 py-1">Usuario denunciado</th>
          <th class="border px-2 py-1">Motivo</th>
          <th class="border px-2 py-1">Estado</th>
          <th class="border px-2 py-1">Fecha</th>
          <th class="border px-2 py-1">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="denuncia in denunciasUsersFiltradas" :key="denuncia.id">
          <td class="border px-2 py-1">{{ denuncia.id }}</td>
          <td class="border px-2 py-1">
            {{ denuncia.usuario_denunciado.name }} {{ denuncia.usuario_denunciado.last_name }}
          </td>
          <td class="border px-2 py-1">{{ denuncia.motivo_denuncia.nombre }}</td>
          <td class="border px-2 py-1">{{ denuncia.estado_denuncia.nombre }}</td>
          <td class="border px-2 py-1">{{ formatDate(denuncia.created_at) }}</td>
          <td class="border px-2 py-1">
            <select
              @change="accionSeleccionada($event, denuncia.id, 'usuario')"
              class="border px-1 py-1 rounded"
            >
              <option value="">Seleccionar</option>
              <option value="1">Aceptar</option>
              <option value="2">Ignorar</option>
              <option value="3">Rechazar</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>

    <h3 class="text-lg font-semibold mb-2">🔸 Denuncias a Publicaciones</h3>
    <table class="min-w-full border">
      <thead class="bg-gray-100">
        <tr>
          <th class="border px-2 py-1">ID</th>
          <th class="border px-2 py-1">Usuario</th>
          <th class="border px-2 py-1">Motivo</th>
          <th class="border px-2 py-1">Estado</th>
          <th class="border px-2 py-1">Fecha</th>
          <th class="border px-2 py-1">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="denuncia in denunciasPubsFiltradas" :key="denuncia.id">
          <td class="border px-2 py-1">{{ denuncia.id }}</td>
          <td class="border px-2 py-1">
            {{ denuncia.usuario.name }} {{ denuncia.usuario.last_name }}
          </td>
          <td class="border px-2 py-1">{{ denuncia.motivo_denuncia.nombre }}</td>
          <td class="border px-2 py-1">{{ denuncia.estado_denuncia.nombre }}</td>
          <td class="border px-2 py-1">{{ formatDate(denuncia.created_at) }}</td>
          <td class="border px-2 py-1">
            <select
              @change="accionSeleccionada($event, denuncia.id, 'publicacion')"
              class="border px-1 py-1 rounded"
            >
              <option value="">Seleccionar</option>
              <option value="1">Aceptar</option>
              <option value="2">Ignorar</option>
              <option value="3">Rechazar</option>
            </select>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import api from '../../axios'

const denunciasPubs = ref([])
const denunciasUsers = ref([])
const error = ref('')
const mensaje = ref()
const estadoSeleccionado = ref('') // slug como 'pendiente'

onMounted(async () => {
  try {
    const res1 = await api.get('/getAllDenunciasUsuarios')
    denunciasUsers.value = res1.data

    const res2 = await api.get('/getAllDenunciasPublicaciones')
    denunciasPubs.value = res2.data
  } catch (e) {
    console.error(e)
    error.value = 'Error al cargar las denuncias'
  }
})

const denunciasUsersFiltradas = computed(() => {
  if (!estadoSeleccionado.value) return denunciasUsers.value
  return denunciasUsers.value.filter((d) => d.estado_denuncia.slug === estadoSeleccionado.value)
})

const denunciasPubsFiltradas = computed(() => {
  if (!estadoSeleccionado.value) return denunciasPubs.value
  return denunciasPubs.value.filter((d) => d.estado_denuncia.slug === estadoSeleccionado.value)
})

const formatDate = (fecha) => {
  return new Date(fecha).toLocaleString()
}

const accionSeleccionada = async (event, idDenuncia, tipo) => {
  const accion = event.target.value
  if (tipo == 'publicacion') {
    try {
      const response = await api.post(`/updateDenunciaPub/${idDenuncia}/${accion}`)
      mensaje.value = response.data.message
      console.log(response.data)
      setTimeout(() => {
        mensaje.value = ''
      }, 2000)
    } catch (e) {
      console.error(e)
      mensaje.value = 'Error al realizar la acción'
      setTimeout(() => {
        mensaje.value = ''
      }, 2000)
    }
  } else {
    try {
      const response = await api.post(`/updateDenunciaUser/${idDenuncia}/${accion}`)
      mensaje.value = response.data.message
      console.log(response.data)
      setTimeout(() => {
        mensaje.value = ''
      }, 2000)
    } catch (e) {
      console.error(e)
      mensaje.value = 'Error al realizar la acción'
      setTimeout(() => {
        mensaje.value = ''
      }, 2000)
    }
  }
}
</script>

<!-- <script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRoute } from 'vue-router'
import Denuncias from './Denuncias.vue'

const error = ref('')

const user = ref('')
const id_user = ref('')
const denunciasPubs = ref('')
const denunciasUsers = ref('')

const route = useRoute()

onMounted(async () => {
  try {
    const res1 = await api.get('/getAllDenunciasUsuarios')
    denunciasPubs.value = res1.data
    const res2 = await api.get('/getAllDenunciasPublicaciones')
    denunciasUsers.value = res2.data

    console.log(denunciasUsers.value)
    console.log(denunciasPubs.value)
  } catch (e) {
    console.error(e)
    error.value = 'Error al cargar datos del perfil'
  }
})

const algo = async () => {
  try {
    // const res = await api.post('/storeDenunciaProfile', denuncia.value)
    // mensaje.value = res.data.message
  } catch (e) {
    // error.value = e.response.data.message
  }
}
</script> -->
