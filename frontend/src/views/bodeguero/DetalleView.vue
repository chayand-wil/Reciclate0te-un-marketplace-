<template>
  <!-- MODAL -->
  <div v-if="mostrarModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white text-black rounded-xl p-6 w-full max-w-md shadow-xl">
      <h2 class="text-lg font-bold mb-4"></h2>

      <label class="block mb-2">Reporte de recepcion del articulo</label>
      <label class="block mb-2">Ingrese observaciones</label>
      <input
        v-model="reporte_bodega.observaciones_del_receptor"
        type="textarea"
        class="w-full p-2 rounded border border-gray-300 mb-4"
        min="10"
      />
      <label for="">Verificar el estado del artículo si fuera necesario</label>
      <select
        v-model="reporte_bodega.id_estado_verificado"
        class="w-full p-2 rounded border border-gray-300 mb-4"
      >
        <option disabled value="">Selecciona el estado verificado</option>
        <option v-for="n in estados" :key="n.id" :value="n.id">{{ n.nombre }}</option>
      </select>

      <div class="flex justify-end space-x-2">
        <button
          class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded"
          @click="cerrarModal"
        >
          Cancelar
        </button>
        <button
          class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
          @click="crearReporte"
        >
          Guardar
        </button>
      </div>
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

  <!-- UNA PUBLICACION - DETALLE -->
  <div
    class="mt-4 w-full max-w-[900px] mx-auto bg-white/10 backdrop-blur-2xl rounded-2xl p-6 shadow-lg text-white"
  >
    <!-- Encabezado -->
    <div class="text-center mb-10">
      <h1 class="text-3xl font-semibold text-gray-900">{{ article?.nombre }}</h1>
      <p class="text-lg text-white mb-2">Descripcion: {{ article?.descripcion }}</p>
    </div>

    <p>{{ formatFecha(publication?.created_at) }}</p>

    <!-- Contenido principal -->
    <div class="flex mt-4 flex-col lg:flex-row gap-4 w-full max-w-[1600px]">
      <!-- Imagen del producto -->
      <div class="flex-1 flex justify-center">
        <img
          :src="publication?.imagen_url"
          alt="image del articulo"
          class="w-400 h-auto rounded-xl shadow"
        />
      </div>

      <!-- Información y opciones -->
      <div class="flex-1 space-y-6">
        <!-- Selector de tamaño -->
        <div>
          <label class="block text-xl font-medium text-gray-100 mb-1">Estado: </label>
          <p class="w-full border border-gray-300 rounded-md px-4 py-2 text-gray-100">
            {{ article?.estado_articulo?.nombre }}
          </p>
          <br />
          <label class="block text-xl font-medium text-gray-100 mb-1">Calidad: </label>
          <p class="w-full border border-gray-300 rounded-md px-4 py-2 text-gray-100">
            {{ article?.calidad_articulo?.nombre }}
          </p>
        </div>

        <!-- Entrega -->
        <div>
          <p class="text-xl text-gray-400">
            <strong>Para:</strong> {{ article?.tipo_publico?.nombre }}
          </p>
          <p class="text-sm text-indigo-600">
            <span class="underline cursor-pointer"
              >Categoria: {{ article?.categoria?.nombre }}</span
            >
          </p>
        </div>

        <!-- Recoger -->
        <div>
          <p class="text-2xl text-gray-20">
            <strong>Recoger en: </strong>
            <span class="underline cursor-pointer">{{ ubicacion.nombre }}</span>
          </p>
        </div>

        <!-- Botones -->
        <div class="flex flex-col gap-3">
          <button @click="abrirModal(1)" class="bg-black text-white py-3 rounded-md hover:bg-gray-800">
            Registrar recepcion
          </button>
          <button @click="abrirModal(2)" class="bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700">
            Registrar entrega
          </button>
        </div>
      </div>
    </div>
    <br />
    <p class="text-sm text-white">Detalles: {{ article?.detalles }}</p>
  </div>
  <br />

  <!-- Aqui se mostraran los estados -->
  <div class="flex justify-center items-center space-x-8 my-6">
    <div v-for="estado in estadosAdquisicion" :key="estado.slug" class="flex flex-col items-center">
      <div
        :class="[
          'w-6 h-6 rounded-full border-2',
          article?.estado_adquisicion?.slug === estado.slug
            ? 'bg-green-500 border-green-700'
            : 'border-gray-400',
        ]"
      ></div>
      <span class="text-xs text-center mt-2 text-white">{{ estado.nombre }}</span>
    </div>
  </div>

  <!-- Botón para volver -->
  <div class="flex justify-center mt-6">
    <button
      @click="$router.go(-1)"
      class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700"
    >
      Volver
    </button>
  </div>
</template>

<script setup>
import { inject } from 'vue'
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRoute } from 'vue-router'

// Props: si viene como tarjeta

const props = defineProps({
  publication: Object,
  user: Object,
})

const estadosAdquisicion = ref()
const estados = ref()

const reporte_bodega = ref({
  id_solicitud: null,
  id_estado_verificado: null,
  id_user_bodeguero: null,
  id_tipo_reporte: null,
  observaciones_del_receptor: '',
})

 

const emit = defineEmits(['enviar-id'])
const route = useRoute()
const publication = ref(props.publication ?? null)
const dataSolicitud = ref()
const user = ref(props.user ?? null)
const article = ref()
const mensaje = ref('')
const error = ref('')
const usuarioLogueado = inject('usuarioLogueado')

const ubicacion = ref('')

const abrirModal = (tipo_reporte) => {
  mostrarModal.value = true
  reporte_bodega.value.id_tipo_reporte = tipo_reporte
}

const mostrarModal = ref(false)
const cerrarModal = () => {
  mostrarModal.value = false
  // usuarioSeleccionado.value = null
}


async function crearReporte(tipoReporte) {
  try {

    mostrarModal.value = false // Cerrar el modal al guardar
    const response = await api.post(`/storeReporteRecepcion`, reporte_bodega.value)
    if (response.status === 201) {
      mensaje.value = response.data.message || 'Reporte creado exitosamente'
      error.value = response.data.message 
      setTimeout(() => {
        mensaje.value = ''
        error.value = ''
      }, 2000)
    }  
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
}
 



const cargarCatalogos = async () => {
  try {
    ubicacion.value = (await api.get(`/get_catalogo/${user.value.id_municipio}/municipio`)).data
    estados.value = (await api.get(`/get_catalogos/estado_articulo`)).data
    estadosAdquisicion.value = (await api.get(`/get_catalogos/articulo_estado_adquisicion`)).data
  } catch (e) {
    console.error('Error cargando catálogos:', e)
  }
}

function formatFecha(fechaRaw) {
  if (!fechaRaw) return 'Sin fecha'
  const fechaISO = fechaRaw.replace(' ', 'T') // Convierte a formato ISO
  const fecha = new Date(fechaISO)
  return isNaN(fecha) ? 'Fecha no válida' : fecha.toLocaleString('es-ES')
}

 
onMounted(async () => {
  try {
    const res = await api.get(`/getSolicitudeAceptada/${route.params.id}`)
    dataSolicitud.value = res.data
    publication.value = res.data.publication
    article.value = res.data.publication.article
    user.value = res.data.user
    console.log(dataSolicitud.value)

    reporte_bodega.value.id_solicitud = dataSolicitud.value.id
    reporte_bodega.value.id_estado_verificado =
      dataSolicitud.value.publication.article.estado_articulo.id
    reporte_bodega.value.id_user_bodeguero = localStorage.getItem('id')
    reporte_bodega.value.observaciones_del_receptor =
      'Observaciones del bodeguero al recibir el artículo'

    await cargarCatalogos()
    //pasar el id de la publicación al componente padre ( submenú)
    emit('enviar-id', publication.value.id)
  } catch (error) {
    console.error(error)
  }
})
</script>
