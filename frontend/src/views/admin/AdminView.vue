<template>
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
  <h1
    class="w-full text-xl mt-20 mb-10 max-w-xs bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
  >
    Registrar Usuarios
  </h1>

  <div
    class="w-full mb-40 max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
  >
    <br />

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
            <option value="1">Administrador</option>
            <option value="2">Administrador de punto de acopio</option>
            <option value="3">Administrador Clasificador</option>
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
  <h1></h1>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'
import { useRegistroUsuario } from '@/composables/useRegistroUsuario'

const {
  nuevo,
  mensaje,
  error,
  municipios,
  focus_name,
  focus_lastname,
  focus_mail,
  focus_password,
  focus_dpi,
  focus_direccion,
  focus_contacto,
  crearUsuario,
} = useRegistroUsuario()

const router = useRouter()

const showModal = ref(false)
const idUser = ref('')
const contador = ref({
  id: '1',
  cantidad: 0,
})

const usuarios = ref([])
// const mensaje = ref('')
// const error = ref('')

// Verifica el rol
onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'admin') {
      router.push('/')
    } else {
      await cargarUsuarios()
      // await cargarContador()
    }
  } catch (e) {
    router.push('/')
  }
})

// update usuario
const updateUser = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    const res = await api.post('/updateUser', userSelected.value)
    mensaje.value = res.data.message

    await cargarUsuarios()
    showModal.value = false
  } catch (e) {
    error.value = e.response.data.message
    console.error()
  }
}

// Cargar usuario
const cargarUser = async (id) => {
  try {
    const res = await api.get(`/uniqueuser/${id}`)
    userSelected.value = res.data
    showModal.value = true
  } catch (e) {
    error.value = 'Error al cargar el usuario'
  }
}

// eliminar un usuario
const deleteUser = async (id) => {
  idUser.value = id
  try {
    const res = await api.get(`/deleteUser/${id}`)
    mensaje.value = 'Usuario eliminado correctamente'
    await cargarUsuarios()
  } catch (e) {
    error.value = 'Error al cargar el usuario'
  }
}

// Crear usuario
const crearUsuariot = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    const res = await api.post('/users', nuevo.value)
    // mensaje.value = 'Usuario creado correctamente'
    mensaje.value = res.data.message
    const idd = res.data.user_id
    console.log('ultimo user insertado id: ' + idd)

    await cargarUsuarios()
  } catch (e) {
    // error.value = 'Error al crear usuario'
    error.value = e.response.data.message
    console.error(e)
  }
}

// Obtener lista de usuarios
const cargarUsuarios = async () => {
  try {
    const res = await api.get('/users')
    usuarios.value = res.data
  } catch (e) {
    error.value = 'Error al cargar usuarios'
  }
}

// Logout
const logout = async () => {
  try {
    await api.post('/logout')
  } catch (e) {}
  localStorage.clear()
  router.push('/')
}
</script>

<style scoped>
.router-link-exact-active {
  color: #3cffa7;
}
</style>
