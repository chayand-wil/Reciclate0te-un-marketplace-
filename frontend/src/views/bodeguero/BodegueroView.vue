<template>
  <div class="p-4">
    <h1 class="text-xl font-bold text-white mb-4">Recepcion de Articulos Solicitados</h1>

     
        <!-- FILTROS -->
    <div class="w-full max-w-6xl bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg mb-6">
      <h2 class="text-lg font-semibold mb-4">Filtrar Solicitudes Aceptadas</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <input
          v-model="filtros.dpi"
          type="text"
          placeholder="Buscar por DPI"
          class="p-2 rounded bg-white/20 placeholder-white text-white"
        />
        <input
          v-model="filtros.email"
          type="text"
          placeholder="Buscar por correo"
          class="p-2 rounded bg-white/20 placeholder-white text-black"
        />
        <select v-model="filtros.genero" class="p-2 rounded bg-white/20 text-black">
          <option value="">Todos los géneros</option>
          <option v-for="g in generos" :key="g.id" :value="g.id">{{ g.nombre }}</option>
        </select>
        <select v-model="filtros.municipio" class="p-2 rounded bg-white/20 text-black">
          <option value="">Todos los municipios</option>
          <option v-for="m in municipios" :key="m.id" :value="m.id">{{ m.nombre }}</option>
        </select>
      </div>

      <!-- <div class="flex justify-end mt-4">
        <button
          @click="aplicarFiltros"
          class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-black"
        >
          Aplicar filtros
        </button>
      </div> -->
    </div>


    <div class="overflow-x-auto bg-white/10 p-4 rounded-xl">
      <table class="w-full table-auto text-white">
        <thead>
          <tr class="text-left border-b border-white/20">
            <th class="p-2">Solicitante</th>
            <th class="p-2">Artículo</th>
            <th class="p-2">Estado</th>
            <th class="p-2">Fecha</th>
            <th class="p-2">Imagen</th>
            <th class="p-2">Acción</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="sol in solicitudes" :key="sol.id" class="border-b border-white/10">
            <td class="p-2">{{ sol.user.name }} {{ sol.user.last_name }}</td>
            <td class="p-2">{{ sol.publication.article.nombre }}</td>
            <td class="p-2">{{ sol.estado_solicitud.nombre }}</td>
            <td class="p-2">{{ formatFecha(sol.created_at) }}</td>
            <td class="p-2">
              <img
                :src="sol.publication.imagen_url"
                class="w-16 h-16 object-cover rounded"
                alt="Imagen artículo"
              />
            </td>
            <td class="p-2">
              <button  @click="router.push({ name: 'detalle_intercambio', params: { id: sol.id } })"  class="bg-blue-500 px-3 py-1 rounded hover:bg-blue-600">
                Gestionar Entrega / Recogida
              </button>
            </td> 
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRoute } from 'vue-router'
import router from '@/router'


const filtros = ref({
  dpi: '',
  email: '',
  genero: '',
  municipio: '',
})


const route = useRoute()
const solicitudes = ref([])

onMounted(async () => {
  const res = await api.get('/all_solicitudes_aceptadas') // Reemplaza con tu endpoint real
  solicitudes.value = res.data
  console.log(solicitudes.value)
})

const formatFecha = (fecha) => {
  return new Date(fecha).toLocaleDateString()
}
</script>
