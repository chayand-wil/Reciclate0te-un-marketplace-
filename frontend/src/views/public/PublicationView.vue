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
<div class="mt-4 w-full max-w-[900px] mx-auto bg-white/10 backdrop-blur-2xl rounded-2xl p-6 shadow-lg text-white">

    <!-- Encabezado -->
    <div class="text-center mb-10">
      <h1 class="text-3xl font-semibold text-gray-900">{{ publication?.article?.nombre }}</h1>
      <p class="text-lg text-white mb-2">Descripcion: {{ publication?.article?.descripcion }}</p>
      
      
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
            {{ estado.nombre }}
          </p>
          <br>
          <label class="block text-xl font-medium text-gray-100 mb-1">Calidad: </label>
          <p class="w-full border border-gray-300 rounded-md px-4 py-2 text-gray-100">
            {{ calidad.nombre }}
          </p>
          
        </div>

        <!-- Entrega -->
        <div>
          <p class="text-xl text-gray-400"><strong>Para:</strong> {{ publico.nombre }}</p>
          <p class="text-sm text-indigo-600">
              <span class="underline cursor-pointer">Categoria: {{categoria.nombre}}</span>
          </p>
        </div>

        <!-- Recoger -->
        <div>
          <p class="text-2xl text-gray-20">
            <strong>Recoger  en: </strong>
            <span class="underline cursor-pointer"   >{{ ubicacion.nombre }}</span>
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
    <p class="text-sm text-white">Detalles: {{ publication?.article?.detalles }}</p>
  </div>
  <br />

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

const categoria = ref('')
const publico = ref('')
const calidad = ref('')
const estado = ref({})
const adquisicion = ref('')
const ubicacion = ref('')

const nuevaSolicitud = ref({
  id_estado_solicitud: null,
  id_publicacion: null,
  id_usuario_nuevo: null,
})

// Carga si no viene por prop
onMounted(async () => {
  if (!publication.value) {
    try {
      const res = await api.get(`/publication/${route.params.id}`)
      publication.value = res.data
      article.value = publication.value.article
      user.value = publication.value.user
    } catch (e) {
      console.error('Error cargando publicación:', e)
    }
  } else {
    article.value = publication.value.article
  }
    // console.log('Solicitudes:', publication.value)
  // Cargar catálogos
  if (publication.value) {
    await cargarCatalogos()
    emit('enviar-id', publication.value.id)
  }
})

// Solicitud
const solicitarArticulo = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    nuevaSolicitud.value.id_estado_solicitud = 1
    nuevaSolicitud.value.id_publicacion = publication.value.id
    nuevaSolicitud.value.id_usuario_nuevo = usuarioLogueado.value.id
    const response = await api.post('/articulo_solicitud', nuevaSolicitud.value)

    if (response.status === 201) {
      mensaje.value = response.data.message
      setTimeout(() => (mensaje.value = ''), 2000)
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
}

// Catálogos
const cargarCatalogos = async () => {
  try {
    // alert('muni iD' + publication.user.id_municipio)
    categoria.value = (await api.get(`/get_catalogo/${article.value.id_categoria_articulo}/categoria_articulo`)).data
    publico.value = (await api.get(`/get_catalogo/${article.value.id_tipo_publico}/tipo_publico`)).data
    calidad.value = (await api.get(`/get_catalogo/${article.value.calidad_articulo}/calidad_articulo`)).data
    estado.value = (await api.get(`/get_catalogo/${article.value.estado_articulo}/estado_articulo`)).data
    adquisicion.value = (await api.get(`/get_catalogo/${article.value.id_articulo_estado_adquisicion}/articulo_estado_adquisicion`)).data
    ubicacion.value = (await api.get(`/get_catalogo/${user.value.id_municipio}/municipio`)).data
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


<!-- {
        "id": 1,
        "imagen_url": "https://wp.salesforce.com/en-us/wp-content/uploads/sites/4/2024/07/production-resource-card-ALGO-720x405-1.png",
        "id_publicacion_visibilidad": 1,
        "cantidad_visualizaciones": 0,
        "created_at": null,
        "article": {
            "nombre": "Bicicleta",
            "descripcion": "articulo de prueba",
            "detalles": "algoooooun detalle",
            "id_categoria_articulo": 2,
            "id_tipo_publico": 1,
            "calidad_articulo": 1,
            "estado_articulo": 1,
            "id_articulo_estado_adquisicion": 1
            "id_municipio": 1,
            }

            "user": {
                "name": "Admin",
                "id_municipio": 1,
                "last_name": "Principal",
                "id_estado": 1,
                "id_rol": 1,
                "id_nivel": 1,
                "cantidad_puntos": 0,
                "detalle_direccion": "Zona 1",
                "created_at": "2025-06-16T02:49:16.000000Z",
                "updated_at": "2025-06-16T02:49:16.000000Z",
                "email_verified_at": null
            },
            






    }, -->
<!-- {
        "id": 1,
        "id_usuario": 1,
        "id_articulo": 1,
        "imagen_url": "https://wp.salesforce.com/en-us/wp-content/uploads/sites/4/2024/07/production-resource-card-ALGO-720x405-1.png",
        "id_publicacion_visibilidad": 1,
        "cantidad_visualizaciones": 0,
        "created_at": null,
        "updated_at": null,
        "user": {
            "id": 1,
            "name": "Admin",
            "last_name": "Principal",
            "email": "admin@ejemplo.com",
            "dpi": "1234567890101",
            "id_estado": 1,
            "id_rol": 1,
            "id_nivel": 1,
            "cantidad_puntos": 0,
            "id_municipio": 1,
            "detalle_direccion": "Zona 1",
            "created_at": "2025-06-16T02:49:16.000000Z",
            "updated_at": "2025-06-16T02:49:16.000000Z",
            "email_verified_at": null
        },
        "article": {
            "id": 1,
            "nombre": "Bicicleta",
            "descripcion": "articulo de prueba",
            "detalles": "algoooooun detalle",
            "id_categoria_articulo": 2,
            "id_tipo_publico": 1,
            "calidad_articulo": 1,
            "estado_articulo": 1,
            "id_articulo_estado_adquisicion": 1
        }
    }, -->
