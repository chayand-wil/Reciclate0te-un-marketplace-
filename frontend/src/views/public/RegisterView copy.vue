<template>
  <!-- <div class="min-h-screen flex items-center justify-center bg-gray-500 px-4"> -->
  <div
    class="min-h-screen flex items-center justify-center bg-gray-500 bg-opacity-20 backdrop-blur-sm"
  >
    <!-- Contenedor con bordes redondeados -->
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




    <div
      class="w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
    >
      <h1>Crear tu cuenta de Reciclate</h1>
      <br />
      <p class="text-2xl text-center text-gray-400">
        <router-link to="/recicla0te.com/login">Iniciar Sesion</router-link>
      </p>
      <br />
      <form @submit.prevent="crearUsuario" autocomplete="off">
        <div class="flex space-x-4 w-full">
          <div class="relative w-1/2">
            <input
              v-model="nuevo.name"
              @focus="focus_name = true"
              @blur="focus_name = false"
              type="text"
              id="nombre"
              placeholder=""
              required
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <label
              :class="[
                'absolute left-6 transition-all',
                focus_name || nuevo.name
                  ? 'top-0.5 text-base text-xs text-blue-500'
                  : 'top-4 text-lg text-gray-500',
              ]"
              for="nombre"
            >
              Nombre
            </label>
          </div>

          <div class="relative w-1/2">
            <input
              v-model="nuevo.last_name"
              @focus="focus_lastname = true"
              @blur="focus_lastname = false"
              type="text"
              id="apellido"
              placeholder=" "
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <label
              :class="[
                'absolute left-6 transition-all',
                focus_lastname || nuevo.last_name
                  ? 'top-0.5 text-base text-xs text-blue-500'
                  : 'top-4 text-lg text-gray-500',
              ]"
              for="apellido"
            >
              Apellido
            </label>
          </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:space-x-4 mt-4">
          <!-- Campo DPI -->
          <div class="relative w-full sm:w-1/2">
            <input
              v-model="nuevo.dpi"
              @focus="focus_dpi = true"
              @blur="focus_dpi = false"
              type="text"
              id="dpi"
              required
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
            <label
              :class="[
                'absolute left-6 transition-all',
                focus_dpi || nuevo.dpi
                  ? 'top-0.5 text-xs text-blue-500'
                  : 'top-4 text-lg text-gray-500',
              ]"
              for="dpi"
            >
              DPI
            </label>
          </div>

          <!-- Campo Fecha de nacimiento -->
          <div class="relative w-full sm:w-1/2 mt-4 sm:mt-0">
            <input
              v-model="nuevo.fecha_nacimiento"
              type="date"
              id="fecha_nacimiento"
              required
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>
        </div>

        <div class="flex flex-col sm:flex-row sm:space-x-4 mt-4">
          <!-- Campo: Rol -->
          <div class="w-full sm:w-1/2">
            <label for="rol" class="text-gray-400 mb-1 block">Seleccione - Genero</label>
            <select
              id="rol"
              v-model="nuevo.id_genero"
              class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="1">Masculino</option>
              <option value="2">Femenino</option>
            </select>
          </div>

          <!-- Campo: Municipio -->
          <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
            <label class="text-gray-400 mb-1 block">Departamento</label>
            <select
              v-model="departamento"
              class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="1">Quetzaltenango</option>
            </select>
          </div>
          <div class="w-full sm:w-1/2 mt-4 sm:mt-0">
            <label class="text-gray-400 mb-1 block">Municipio</label>
            <select
              v-model="nuevo.id_municipio"
              class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option disabled value="">Seleccione un municipio</option>
              <option v-for="m in municipios" :key="m.id" :value="m.id">{{ m.nombre }}</option>
            </select>
          </div>
        </div>

        <div class="relative w-full mt-1">
          <input
            v-model="nuevo.detalle_direccion"
            @focus="focus_direccion = true"
            @blur="focus_direccion = false"
            type="text"
            id="detalle_direccion"
            placeholder=" "
            required
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <label
            :class="[
              'absolute left-6 transition-all',
              focus_direccion || nuevo.detalle_direccion
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="detalle_direccion"
          >
            Detalle - Direccion
          </label>
        </div>

        <div class="relative w-full mt-1">
          <input
            v-model="nuevo.medio_contacto"
            @focus="focus_contacto = true"
            @blur="focus_contacto = false"
            type="text"
            id="medio_contacto"
            placeholder=" "
            required
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <label
            :class="[
              'absolute left-6 transition-all',
              focus_contacto || nuevo.medio_contacto
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="medio_contacto"
          >
            Medio de medio_contacto
          </label>
        </div>
        <hr />
        <div class="mt-4 relative w-full mt-1">
          <input
            autocomplete="new-email"
            v-model="nuevo.email"
            @focus="focus_mail = true"
            @blur="focus_mail = false"
            type="text"
            id="mail"
            placeholder=" "
            required
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <label
            :class="[
              'absolute left-6 transition-all',
              focus_mail || nuevo.email
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="mail"
          >
            Correo electronico
          </label>
        </div>

        <div class="relative w-full mt-1">
          <input
            autocomplete="new-password"
            v-model="nuevo.password"
            @focus="focus_password = true"
            @blur="focus_password = false"
            type="password"
            id="password"
            placeholder=" "
            required
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
          <label
            :class="[
              'absolute left-6 transition-all',
              focus_password || nuevo.password
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="password"
          >
            Ingrese una contrasena
          </label>
        </div>

        <div class="flex flex-col sm:flex-row sm:space-x-4 mt-4">
          <!-- Campo: Rol -->
          <div class="w-full sm:w-1/2">
            <label for="rol" class="text-gray-400 mb-1 block">Seleccione - Rol</label>
            <select
              id="rol"
              v-model="nuevo.id_rol"
              class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <!-- <option value="1">Administrador</option> -->
              <!-- <option value="2">Administrador de punto de acopio</option>         
      <option value="3">Administrador Clasificador</option> -->
              <option value="4">Reutilizador</option>
              <option value="5">Ecoemprendedor</option>
            </select>
          </div>
        </div>

        <div class="w-full flex justify-between mt-6">
          <router-link
            to="/recicla0te.com/visitor"
            class="w-1/4 text-center text-green-400 px-4 py-2 rounded-md hover:bg-green-400 hover:text-white transition"
          >
            Cancelar
          </router-link>
          <button
            type="submit"
            class="w-1/4 text-center text-green-400 border border-green-400 px-4 py-2 rounded-md hover:bg-green-400 hover:text-white transition"
          >
            Continuar
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const apellido = ref('')

const focus_name = ref(false)
const focus_lastname = ref(false)
const focus_mail = ref(false)
const focus_password = ref(false)
const focus_dpi = ref(false)
const focus_direccion = ref(false)
const focus_contacto = ref(false)

const municipios = ref([])

const mensaje = ref('')
const error = ref('')

const departamento = 1

const nuevo = ref({
  name: '',
  last_name: '',
  email: '',
  password: '',
  dpi: '',
  id_estado: 1,
  id_rol: 4,
  id_nivel: 1,
  cantidad_puntos: 0,
  id_municipio: 1,
  fecha_nacimiento: '',
  id_genero: 2,
  detalle_direccion: '',
  medio_contacto: '', 
})

onMounted(async () => {
  try {
    const res = await api.get(`/get_catalogos/municipio`) 
    municipios.value = res.data
  } catch (e) {
    error.value = e.res.message
    router.push('/')
  }
})

const crearUsuario = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    const response = await api.post('/register', nuevo.value)
    if (response.status === 201) {
      mensaje.value = response.data.message
      setTimeout(() => {
        mensaje.value = ''
      }, 2000) // 4 segundos en lugar de 1
      await login() // Iniciar sesion automaticamente
    }
  } catch (e) {
    if (e.response && e.response.status === 422) {
      const errores = e.response.data.errors
      // Unir todos los mensajes de error en una sola cadena
      error.value = ' Error ' + Object.values(errores).flat().join(', ')
      setTimeout(() => {
        mensaje.value = ''
        error.value = ''
      }, 2000) // 4 segundos en lugar de 1
    }
  }
}





const login = async () => {
  try {
    const response = await api.post('/login', {
      email: nuevo.value.email,
      password: nuevo.value.password,
    })    

    const token = response.data.access_token
    const role = response.data.user.rol.slug
    const id = response.data.user.id

    localStorage.setItem('token', token)
    localStorage.setItem('role', role)
    localStorage.setItem('id', id)

    switch (role) {
      case 'admin':
        router.push('/admin')
        break
      case 'bodeguero':
        router.push('/bodeguero')
        break
      case 'reutilizador':
        router.push('/reutilizador')
        break
      case 'clasificador':
        alert('Clasificador')
        router.push('/clasificador')
        break
      default:
        router.push('/')
    }
  } catch (err) {
    // error.value =  err.response.data.message
    error.value = 'Credenciales incorrectas'
  }
}
</script>
