<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-500">
    <!-- <div class="min-h-screen flex items-center justify-center bg-gray-500 bg-opacity-50 backdrop-blur-sm">   -->
    <div
      class="bg-white p-14 rounded-[3rem] hover:shadow-[0_15px_70px_rgba(0,0,0,0.8)] w-full max-w-2xl space-y-4"
    >
      <img src="@/assets/logo_3r.png" alt="Logo" class="mx-auto h-64 w-auto" />
      <h1 class="text-2xl font-bold text-center text-gray-800">Iniciar sesión</h1>

      <div class="relative">
        <label class="absolute left-3 top-2 text-gray-500 text-sm pointer-events-none">
          Ingresa tu correo electrónico
        </label>
        <input
          v-model="email"
          type="email"
          placeholder="ejemplo@gmail.com"
          required
          class="w-full pt-7 pb-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
        />
      </div>

      <p v-if="SubmitEvent && !email" class="text-red-600 text-sm">El correo es obligatorio</p>

      <div class="relative">
        <label class="absolute left-3 top-2 text-gray-500 text-sm pointer-events-none">
          Ingresa tu contraseña
        </label>
        <input
          v-model="password"
          type="password"
          placeholder="juan123AAA"
          required
          class="w-full pt-7 pb-2 px-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
        />
      </div>

      <p v-if="SubmitEvent && !password" class="text-red-600 text-sm">Introduce la contrasenia</p>

      <button
        @click="login"
        class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition"
      >
        Entrar
      </button>

      <p v-if="error" class="text-red-600 text-sm text-center">{{ error }}</p>
<br>
      <p  class=" text-red-600 text-sm text-center">
        <router-link to="/recicla0te.com/register">Registrate ahora!</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
// import axios from 'axios'
import api from '../axios'

import { useRouter } from 'vue-router'

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
      const role = response.data.user.role

      localStorage.setItem('token', token)
      localStorage.setItem('role', role)

      if (role === 'admin') {
        router.push('/admin')
      } else {
        router.push('/ayudante')
      }
    } catch (err) {
      error.value = 'Credenciales incorrectas'
    }
  }
}
</script>
