<template>
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
          <button
            @click="solicitarArticulo"
            class="bg-black text-white py-3 rounded-md hover:bg-gray-800"
          >
            Solicitar Artículo
          </button>
          <button class="bg-indigo-600 text-white py-3 rounded-md hover:bg-indigo-700">
            Cancelar Solicitud
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

  />
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

const emit = defineEmits(['enviar-id'])
const route = useRoute()
const publication = ref(props.publication ?? null)
const user = ref(props.user ?? null)
const article = ref()
const mensaje = ref('')
const error = ref('')
const usuarioLogueado = inject('usuarioLogueado')

const ubicacion = ref('')
const estadosAdquisicion = ref('')

const nuevaSolicitud = ref({
  id_estado_solicitud: null,
  id_publicacion: null,
  id_usuario_nuevo: null,
})

// Carga si no viene por prop
const cargarInfo = async () => {
  try {
    const res = await api.get(`/publication/${route.params.id}`)
    publication.value = res.data
    article.value = publication.value.article
    user.value = publication.value.user
  } catch (e) {
    console.error('Error cargando información de la publicación:', e)
  }
}

onMounted(async () => {
  if (!publication.value) {
    try {
      await cargarInfo()
    } catch (e) {
      console.error('Error cargando publicación:', e)
    }
  } else {
    article.value = publication.value.article
  }
  console.log('Solicitudes:', publication.value)
  // Cargar catálogos
  if (publication.value) {
    await cargarCatalogos()
    //pasar el id de la publicación al componente padre ( submenú)
    emit('enviar-id', publication.value.id)
  }
})

// Solicitud
const solicitarArticulo = async () => {
  mensaje.value = ''
  error.value = ''
  // alert('puntos...' + usuarioLogueado.value.cantidad_puntos)
  if (usuarioLogueado.value.cantidad_puntos >= 100) {
    try {
      nuevaSolicitud.value.id_estado_solicitud = 1
      nuevaSolicitud.value.id_publicacion = publication.value.id
      nuevaSolicitud.value.id_usuario_nuevo = usuarioLogueado.value.id
      const response = await api.post('/articulo_solicitud', nuevaSolicitud.value)

      if (response.status === 201) {
        mensaje.value = response.data.message
        setTimeout(() => (mensaje.value = ''), 2000)
        await cargarInfo()
      }
    } catch (e) {
      if (e.response && e.response.status === 422) {
        const errores = e.response.data.errors
        error.value = 'Error ' + Object.values(errores).flat().join(', ')
        setTimeout(() => {
          mensaje.value = ''
          error.value = ''
        }, 2000)
      }
      console.error(e)
    }
  } else {
    mensaje.value =
      'Necesitas 100 puntos para solicitar este artículo. Vamos a conseguir más puntos!.'
    setTimeout(() => {
      mensaje.value = ''
      error.value = ''
    }, 2000)
  }
}

// Catálogos
const cargarCatalogos = async () => {
  try {
    ubicacion.value = (await api.get(`/get_catalogo/${user.value.id_municipio}/municipio`)).data
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
</script>
