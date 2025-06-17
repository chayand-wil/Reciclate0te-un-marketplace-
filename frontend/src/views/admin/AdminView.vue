<template>
  <div>

    <div class="mt-16 w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white">
      <h1>Registrar usuario</h1>
      <br>
      <br>
      <h2>algo</h2>      
      
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
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
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
              v-model="apellido"
              @focus="focus_lastname = true"
              @blur="focus_lastname = false"
              type="text"
              id="apellido"
              placeholder=" "
              class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
            />
            <label
              :class="[
                'absolute left-6 transition-all',
                focus_lastname || apellido
                  ? 'top-0.5 text-base text-xs text-blue-500'
                  : 'top-4 text-lg text-gray-500',
              ]"
              for="apellido"
            >
              Apellido
            </label>
          </div>
        </div>

        <div class="relative w-full mt-1">
          <input
            autocomplete="new-email"
            v-model="nuevo.email"
            @focus="focus_mail = true"
            @blur="focus_mail = false"
            type="text"
            id="mail"
            placeholder=" "
            required
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
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
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"
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

        <div class="mt-4">
          <label for="id_rol" class="block text-gray-400 mb-1">Rol</label>
          <select
            id="id_rol"
            v-model="nuevo.id_rol"
            class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200"
          >
          <option value="1">Administrador</option>
          <option value="2">Administrador de punto de acopio</option>         
          <option value="3">Administrador Clasificador</option>
          <option value="4">Reutilizador</option>
          <option value="5">Ecoemprendedor</option>
        </select>
        </div>

        <label class="block mt-4 text-gray-400 mb-1">Fecha de nacimiento</label>
        <div class="flex gap-2">
          <select class="w-1/3 bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
            <option>Día</option>
          </select>
          <select class="w-1/3 bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
            <option>Mes</option>
          </select>
          <select class="w-1/3 bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-200">
            <option>Año</option>
          </select>
        </div>

        <div class="flex justify-between mt-6">
          <button
          type="submit"
            class="block mx-auto w-2/4 text-center text-green-400 border border-green-400 px-4 py-2 rounded-md hover:bg-green-400 hover:text-white transition"
          >
            Continuar
          </button>
        </div>
      </form>

    </div>

    

    




    <div class="mt-10">

      <p v-if="mensaje" style="color: green">{{ mensaje }}</p>
      <p v-if="error" style="color: red">{{ error }}</p>
    </div>
      
    <h3 style="margin-top: 2rem">Usuarios registrados:</h3>
    <ul>
      <li v-for="u in usuarios" :key="u.id">
        {{ u.name }} ({{ u.email }}) - Rol: {{ u.id_rol }}
        <button @click="cargarUser(u.id)">Editar</button>
        <button @click="deleteUser(u.id)">Eliminar</button>
      </li>
    </ul>

    <br />






    <label> Contador: {{ contador.cantidad }}</label>

    <div class="bg-red-500 text-white p-4 rounded-lg">
      <button @click="sumar">Sumarrr</button>
      <button @click="restar">Restar</button>
    </div>
  </div>



 
    <!-- Modal -->
    <div
      v-if="showModal"
      class="fixed inset-0 flex items-center justify-center bg-white/10 backdrop-blur-sm rounded-2xl bg-opacity-50 z-50"
    >
     <div class="w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg ">
        <h2 class="text-xl font-bold mb-4">Editar usuario</h2>

        <label for="nombre">Nombre</label>
        <input
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"

          v-model="userSelected.name"
          value="{{userSelected.name}}"
          id="nombre"
        />

        <label for="rol_edit">Rol</label>

        <select
          v-model="userSelected.id_rol"
            class="peer w-full h-14 px-6 rounded-md bg-neutral-800 text-white text-xl placeholder-transparent focus:outline-none focus:ring-2 focus:ring-green-200"

        >
          <option value="admin">Admin</option>
          <option value="ayudante">Ayudante</option>
        </select>

        <div class="flex mt-20 justify-end gap-2">
          <button
            class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400"
            @click="showModal = false"
          >
            Cancelar
          </button>

          <button
            class="border border-teal-500 text-teal-600 hover:bg-teal-100 dark:hover:bg-teal-800 font-semibold py-2 px-4 rounded-xl"
            @click="updateUser()"
          >
            Guardar Cambios
          </button>
        </div>

        <!-- Botón de cerrar (esquina) -->
        <button
          class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl font-bold"
          @click="showModal = false"
        >
          &times;
        </button>
      </div>
    </div>
   

 
</template>



<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'



const focus_name = ref(false)
const focus_lastname = ref(false)
const focus_mail = ref(false)
const focus_password = ref(false)


const router = useRouter()

const showModal = ref(false)
const idUser = ref('')
const contador = ref({
  id: '1',
  cantidad: 0,
})

const usuarios = ref([])
const mensaje = ref('')
const error = ref('')

// Verifica el rol
onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'admin') {
      router.push('/')
    } else {
      await cargarUsuarios()
      await cargarContador()
    }
  } catch (e) {
    router.push('/')
  }
})

const sumar = () => {
  const id = contador.value.cantidad
  contador.value.cantidad = id + 1
  updateContador()
}
const restar = () => {
  
  const id = contador.value.cantidad
  if(id >= 1) {
    contador.value.cantidad = id - 1
    updateContador()

  }
}

const updateContador = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    const res = await api.post('/update_contador', contador.value)
    await cargarContador()
  } catch (e) {
    error.value = e.response.data.message
  }
}

const cargarContador = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    const res = await api.get(`/get_contador/${contador.value.id}`)
    contador.value = res.data
  } catch (e) {
    error.value = res.data.message
  }
}

// Estados
const nuevo = ref({
  name: '',
  email: '',
  password: '', 
  id_rol: 4, // Por defecto, 4 el rol es 'reutilizador'
})

const userSelected = ref({
  id: '',
  name: '',
  email: '',
  password: '',
  id_rol: '',
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
const crearUsuario = async () => {
  mensaje.value = ''
  error.value = ''
  try {
    const res = await api.post('/users', nuevo.value)
    // mensaje.value = 'Usuario creado correctamente'
    mensaje.value = res.data.message
    const idd = res.data.user_id 
    console.log("ultimo user insertado id: " + idd)

    nuevo.value = { name: '', email: '', password: '', id_rol: 4 }
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
