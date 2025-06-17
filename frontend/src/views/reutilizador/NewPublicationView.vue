<template>
  <div class="mt-16">
    <div
      class="mt-16 w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
    >
      <p class="text-xm text-center text-gray-400">Crear publicacion</p>
      <br />

      <form @submit.prevent="crearArticulo">
        <div class="flex space-x-4 w-full">
          <div class="relative">
            <input
              v-model="article.nombre"
              @focus="focus_name = true"
              @blur="focus_name = false"
              type="text"
              id="nombre"
              placeholder=""
              required
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
            />
            <label
              :class="[
                'absolute left-6 transition-all',
                focus_name || article.nombre
                  ? 'top-0.5 text-base text-xs text-blue-500'
                  : 'top-4 text-lg text-gray-500',
              ]"
              for="nombre"
            >
              Nombre articulo
            </label>
          </div>

          <div class="relative">
            <input
              v-model="article.descripcion"
              @focus="focus_descripcion = true"
              @blur="focus_descripcion = false"
              type="text"
              id="descripcion"
              placeholder=" "
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
            />
            <label
              :class="[
                'absolute left-6 transition-all',
                focus_descripcion || article.descripcion
                  ? 'top-0.5 text-base text-xs text-blue-500'
                  : 'top-4 text-lg text-gray-500',
              ]"
              for="descripcion"
            >
              Descripcion corta
            </label>
          </div>
        </div>

        <div class="relative mt-4 w-full mt-1">
          <textarea
            v-model="article.detalles"
            @focus="focus_detalles = true"
            @blur="focus_detalles = false"
            type="text"
            id="detalles"
            placeholder=" "
            required
            class="peer w-full h-36 px-6 py-4 rounded-md bg-neutral-800 text-white text-xm placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
          >
          </textarea>

          <label
            :class="[
              'absolute left-6 transition-all',
              focus_detalles || article.detalles
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-xl text-gray-500',
            ]"
            for="detalles"
          >
            Detalles - recomendaciones
          </label>
        </div>

        <!-- <div>
      <label>Tipo de público:</label>
      <select v-model="form.id_tipo_publico" required>
        <option disabled value="">Seleccione un tipo</option>
        <option v-for="tipo in tiposPublico" :key="tipo.id" :value="tipo.id">
          {{ tipo.nombre }}
        </option>
      </select>
    </div> -->

        <div class="mt-4">
          <label for="id_categoria_articulo" class="block text-gray-400 mb-1">Categoria</label>
          <select
            id="id_categoria_articulo"
            v-model="article.id_categoria_articulo"
            class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200"
          >
            <option value="1">Adulto</option>
            <option value="2">Ninios</option>
            <option value="4">Familiar</option>
          </select>
        </div>

        <div class="mt-4">
          <label for="id_tipo_publico" class="block text-gray-400 mb-1">Tipo publico</label>
          <select
            id="id_tipo_publico"
            v-model="article.id_tipo_publico"
            class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200"
          >
            <option value="1">Adulto</option>
            <option value="2">Ninios</option>
            <option value="4">Familiar</option>
          </select>
        </div>

        <div class="mt-4">
          <label for="calidad_articulo" class="block text-gray-400 mb-1"
            >Calidad (Materiales de alta durabilidad / marcas reconocidas, etc. )</label
          >
          <select
            id="calidad_articulo"
            v-model="article.calidad_articulo"
            class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200"
          >
            <option value="1">Adulto</option>
            <option value="2">Ninios</option>
            <option value="4">Familiar</option>
          </select>
        </div>

        <div class="mt-4">
          <label for="estado_articulo" class="block text-gray-400 mb-1"
            >Estado actual del articulo (Aun se le puede dar una segunda vida?)</label
          >
          <select
            id="estado_articulo"
            v-model="article.estado_articulo"
            class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200"
          >
            <option value="1">Adulto</option>
            <option value="2">Ninios</option>
            <option value="4">Familiar</option>
          </select>
        </div>

        <label for=""></label>
        <div class="flex w-full relative">
          <input
            v-model="pub.imagen_url"
            @focus="focus_imagen_url = true"
            @blur="focus_imagen_url = false"
            type="text"
            id="imagen_url"
            placeholder=""
            required
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
          />
          <label
            :class="[
              'absolute left-6 transition-all',
              focus_imagen_url || pub.imagen_url
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="imagen_url"
          >
            Enlace de imagen
          </label>
        </div>

        <div class="w-full flex justify-between mt-6">
          <button
            type="submit"
            class="block mx-auto w-2/4 text-center text-green-400 border border-green-400 px-4 py-2 rounded-md hover:bg-green-400 hover:text-white transition"
          >
            Publicar ahora!
          </button>
        </div>
      </form>
    </div>

    <!-- Contenedor flotante -->
    <div class="fixed top-20 right-40 z-50 space-y-4 w-[300px]">
      <!-- Mensaje de éxito -->
      <div
        v-if="mensaje"
        class="bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
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
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'

const focus_name = ref(false)
const focus_detalles = ref(false)
const focus_descripcion = ref(false)
const focus_imagen_url = ref(false)

const router = useRouter()

const mensaje = ref('')
const error = ref('')

const user = ref({
  id: null,
  name: '',
  email: '',
})

// Estados
const id_articulo = ref(0)
const id_user = ref(0)
const article = ref({
  //articulo
  nombre: 'Bicicleta',
  descripcion: ' articulo de prueba',
  detalles: 'algoooooun detalle',
  id_categoria_articulo: 2,
  id_tipo_publico: 1,
  calidad_articulo: 1,
  estado_articulo: 1,
  id_articulo_estado_adquisicion: 1,
})

const pub = ref({
  //publicacion
  id_usuario: id_user.value,
  id_articulo: id_articulo.value,
  imagen_url: 'https://i.ebayimg.com/images/g/73oAAOSwy4Jkw-va/s-l400.jpg',
  id_publicacion_visibilidad: 1, //visivilidad pendiente
})

// Verifica el rol
onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'reutilizador') {
      router.push('/')
    } else {
      user.value = res.data
      pub.value.id_usuario = user.value.id // Asignar el ID del usuario a la publicación

      //cargar filtros, categorias, tipos de publicos, calidades, estados
      // await cargarUsuarios()
    }
  } catch (e) {
    router.push('/')
  }
})

// Crear publicacion
const crearPublicacion = async () => {
  mensaje.value = ''
  error.value = ''

  try {
    const response = await api.post('/publication', pub.value)

    if (response.status === 201) {
      mensaje.value = response.data.message

      setTimeout(() => {
        mensaje.value = ''
      }, 3000) // 3 segundos en lugar de 1
    }
  } catch (e) {
    const res = e.response

    if (res && res.status === 422) {
      const errores = res.data.errors
      error.value = 'Error: ' + Object.values(errores).flat().join(', ')
    } else {
      // error.value = res?.data?.error || 'Error inesperado'
      mensaje.value = res?.data?.message || ''
    }

    setTimeout(() => {
      error.value = ''
    }, 5000)

    console.error(e)
  }
}

const crearArticulo = async () => {
  mensaje.value = ''
  error.value = ''

  try {
    const response = await api.post('/articulo', article.value)
    id_articulo.value = response.data.id // Guardar el ID del artículo creado
    pub.value.id_articulo = id_articulo.value // Asignar el ID del artículo

    if (response.status === 201) {
      // Ocultar mensaje automáticamente a los 3 segundos
      setTimeout(() => {
        mensaje.value = ''
      }, 3000)
    }
  } catch (e) {
    if (e.response && e.response.status === 422) {
      const errores = e.response.data.errors
      // Unir todos los mensajes de error en una sola cadena
      error.value = ' Error ' + Object.values(errores).flat().join(', ')
      // Ocultar error automáticamente a los 5 segundos
      setTimeout(() => {
        error.value = ''
      }, 5000)
    }

    console.error(e)
  }

  // Crear la publicación
  // if (Number(id_articulo.value) !== 0) {

  if (id_articulo.value !== 0) {
    await crearPublicacion()
  }
}
</script>

<style scoped>
.router-link-exact-active {
  color: #3cffa7;
}
</style>
