<template>
  <div class="flex mt-20 flex-col items-center justify-start min-h-screen text-white">
    <!-- FILTROS -->
    <div class="w-full max-w-4xl bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg mb-6">
      <h2 class="text-lg font-semibold mb-4">Filtrar usuarios</h2>
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

      <div class="flex justify-end mt-4">
        <!-- <button
          @click="aplicarFiltros"
          class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-black"
        >
          Aplicar filtros
        </button> -->
      </div>
    </div>

    <!-- TABLA -->
    <div class="w-full max-w-4xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg">
      <h1 class="text-xl font-bold mb-4">Lista de usuarios</h1>

      <table class="w-full text-left table-auto border-collapse">
        <thead>
          <tr class="border-b border-white">
            <th class="p-2">Nombre</th>
            <th class="p-2">Dpi</th>
            <th class="p-2">Correo</th>
            <th class="p-2">Puntos</th>
            <th class="p-2">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="usuario in usuariosFiltrados"
            :key="usuario.id"
            class="border-b border-white/30 hover:bg-white/10"
          >
            <td class="p-2">{{ usuario.name }} {{ usuario.last_name }}</td>
            <td class="p-2">{{ usuario.dpi }}</td>
            <td class="p-2">{{ usuario.email }}</td>
            <td class="p-2">{{ usuario.cantidad_puntos }}</td>
            <td class="p-2">
              <button
                class="bg-green-500 hover:bg-green-600 text-white py-1 px-3 rounded"
                @click="verUser(usuario)"
              >
                Verificar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Contenedor flotante MENSAJES -->
  <div class="fixed top-20 right-40 z-50 space-y-4 w-[300px]">
    <!-- Mensaje de éxito -->
    <div
      v-if="mensaje"
      class="bg-white/20 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-xl text-verdee"
    >
      {{ mensaje }}
    </div>

    <!-- Mensaje de error de validación -->
    <div
      v-if="error"
      class="bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-xl text-red-600"
    >
      {{ error }}
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'

const mensaje = ref('')
const error = ref('')
const usuarios = ref([])
const generos = ref([])
const municipios = ref([])

const usuarioSeleccionado = ref(null)

const filtros = ref({
  dpi: '',
  email: '',
  genero: '',
  municipio: '',
})

const router = useRouter()

const verUser = (id) => {
  const id_user = id.id // Asignar el ID del usuario seleccionado
  router.push({
    name: 'detalle_user',
    params: { id: id_user },
  })
}

async function cargarUsuarios() {
  try {
    const response = await api.get('/all_users')
    usuarios.value = response.data
    console.log(usuarios.value)
  } catch (error) {
    console.error('Error al cargar usuarios:', error)
  }
}

async function guardarPuntos(usuarioId, cantidad) {
  cantidad = Number(cantidad) * 10 // Convertir a puntos
  try {
    const response = await api.post('/guardar_puntos', {
      id: usuarioId,
      cantidad_puntos: cantidad,
    })
    await cargarUsuarios() // Recargar usuarios después de guardar puntos
    console.log('Puntos guardados:', response.data)
    mensaje.value = 'Puntos guardados exitosamente.'
    setTimeout(() => {
      mensaje.value = ''
    }, 2000)
  } catch (error) {
    console.error('Error al guardar puntos:', error)
  }
}

// const aplicarFiltros = () => {
//
// }

const usuariosFiltrados = computed(() => {
  return usuarios.value.filter((u) => {
    const coincideDPI = filtros.value.dpi === '' || u.dpi.includes(filtros.value.dpi)
    const coincideEmail =
      filtros.value.email === '' ||
      u.email.toLowerCase().includes(filtros.value.email.toLowerCase())
    const coincideGenero =
      filtros.value.genero === '' || u.id_genero === Number(filtros.value.genero)
    const coincideMunicipio =
      filtros.value.municipio === '' || u.id_municipio === Number(filtros.value.municipio)
    return coincideDPI && coincideEmail && coincideGenero && coincideMunicipio
  })
})

onMounted(async () => {
  try {
    await cargarUsuarios()

    const resGeneros = await api.get('/generos') // Ajusta endpoint si es necesario
    generos.value = resGeneros.data

    const resMunicipios = await api.get('/municipios') // Ajusta endpoint si es necesario
    municipios.value = resMunicipios.data
  } catch (e) {
    router.push('/')
  }
})
</script>

<style scoped>
.router-link-exact-active {
  color: #3cffa7;
}
</style>
