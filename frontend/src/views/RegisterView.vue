<template>
  <!-- <div class="min-h-screen flex items-center justify-center bg-gray-500 px-4"> -->
    <div class="min-h-screen flex items-center justify-center bg-gray-500 bg-opacity-20 backdrop-blur-sm">  
    
    <!-- Contenedor con bordes redondeados -->
    
     <div class="w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white">

      
      <h1>Crear tu cuenta de Reciclate</h1>
      <br>
      <p class="  text-2xl text-center text-gray-400 ">
        <router-link to="/recicla0te.com/login">Iniciar Sesion</router-link>
      </p>
      <br>
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
              v-model="apellido"
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

        <div class="mt-4">
          <label for="role" class="block text-gray-400 mb-1">Rol</label>
          <select
            id="role"
            v-model="nuevo.id_rol"
            class="w-full bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          >
          <option value="1">Administrador</option>
          <!-- <option value="2">Administrador de punto de acopio</option>         
          <option value="3">Administrador Clasificador</option> -->
          <option value="4">Reutilizador</option>
          <option value="5">Ecoemprendedor</option>
          </select>
        </div>

        <label class="block mt-4 text-gray-400 mb-1">Fecha de nacimiento</label>
        <div class="flex gap-2">
          <select class="w-1/3 bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Día</option>
          </select>
          <select class="w-1/3 bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Mes</option>
          </select>
          <select class="w-1/3 bg-neutral-800 text-white px-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option>Año</option>
          </select>
        </div>

        <div class="flex justify-between mt-6">
          <router-link
            to="/recicla0te.com/visitor"
            class="w-1/4 text-center text-green-400  px-4 py-2 rounded-md hover:bg-green-400 hover:text-white transition"
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

      <div v-if="mensaje" class="text-green-500 mt-4">{{ mensaje }}</div>
      <div v-if="error" class="text-red-500 mt-4">{{ error }}</div>
    </div>
  </div>
</template>










<script setup>
import { ref, onMounted } from 'vue'
import api from '../axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const apellido = ref('')

const focus_name = ref(false)
const focus_lastname = ref(false)
const focus_mail = ref(false)
const focus_password = ref(false)

const mensaje = ref('')
const error = ref('')

// Verifica el rol
onMounted(async () => {})

const nuevo = ref({
  name: '',
  email: '',
  password: '',
  id_rol: 4, // Por defecto, el rol es 'reutilizador'
})

// Crear usuario
const crearUsuario = async () => {
  // alert('Crear usuario')
  mensaje.value = ''
  error.value = ''
  try {
    const res = await api.post('/register', nuevo.value)
    mensaje.value = 'Usuario creado correctamente'

    await login() // Iniciar sesion automaticamente  

  } catch (err) {
    nuevo.value = { name: '', email: '', password: '', id_rol: 4 }
    error.value = 'Error al crear usuario'
      // error.value = err.response.data.message 
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

      localStorage.setItem('token', token)
      localStorage.setItem('role', role)

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
