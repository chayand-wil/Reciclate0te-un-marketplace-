<template>
  <!-- <div class="min-h-screen flex items-center justify-center bg-gray-500"> -->
    <div class="min-h-screen flex items-center justify-center bg-gray-500 bg-opacity-20 backdrop-blur-sm">  
    <!-- <div
      class="bg-white p-14 rounded-[3rem] hover:shadow-[0_15px_70px_rgba(0,0,0,0.8)] w-full max-w-2xl space-y-4"
    > -->

     <div class="w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-green-400">

      <img src="@/assets/logo_3r.png" alt="Logo" class="mx-auto h-64 w-auto" />
      <h1 class="mt-4 mb-4 text-2xl font-bold text-center ">Iniciar sesión</h1>


         <div class="relative w-full mt-1">
          <input
            v-model="email"
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
              focus_mail || email
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="mail"
          >
            Correo electronico
          </label>
        </div>





      <p v-if="SubmitEvent && !email" class="text-red-600 text-sm">El correo es obligatorio</p>

         <div class="relative w-full mt-1">
          <input
            v-model="password"
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
              focus_password || password
                ? 'top-0.5 text-base text-xs text-blue-500'
                : 'top-4 text-lg text-gray-500',
            ]"
            for="password"
          >
            Ingrese una contrasena
          </label>
        </div>



      <p v-if="SubmitEvent && !password" class="text-red-600 text-sm">Introduce la contrasenia</p>

      <button
        @click="login"
          class="mt-2 w-full text-green-400 border border-green-400 px-4 py-2 rounded-md hover:bg-green-400 hover:text-white transition"
        >
        Entrar
      </button>

      <p v-if="error" class="text-red-600 text-sm text-center">{{ error }}</p>
<br>
<br>
      <p  class=" text-2xl  text-center">
        <router-link to="/recicla0te.com/register">Registrate ahora!</router-link>
      </p>
      

      <button
        class="block mx-auto  text-xm text-black   mt-4 "
        @click="router.push('/')"
      > Seguir como invitado
      </button>

 

    </div>
  </div>
</template>





<script setup>
import { ref } from 'vue'
// import axios from 'axios'
import api from '../../axios'

import { useRouter } from 'vue-router'


  
const focus_name = ref(false)
const focus_lastname = ref(false)
const focus_mail = ref(false)
const focus_password = ref(false)










const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

const SubmitEvent = ref(false)

const login = async () => {
  SubmitEvent.value = true
  if (!email.value || !password.value) {
    error.value = 'Todos los campos son obligatorios'
  } else {
    try {
      const response = await api.post('/login', {
        email: email.value,
        password: password.value,
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
                router.push('/clasificador')
                break
              default:
                router.push('/')
      }


 
    } catch (err) {
      error.value = 'Credenciales incorrectas'
    }
  }
}
</script>
