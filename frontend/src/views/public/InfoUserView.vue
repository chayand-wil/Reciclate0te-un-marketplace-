<template>
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

  <div class="flex flex-col items-center justify-center">
    <div
      class="mt-4 w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-black"
    >
      <!-- Información básica -->
      <div class="backdrop-blur-sm rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Información básica</h2>

        <div class="flex items-center space-x-4 mb-4">
          <img
            src="../../../public/icono_user.png"
            alt="Foto de perfil"
            class="w-16 h-16 rounded-full object-cover"
          />
          <div>
            <p class="text-sm">Imagen de perfil</p>
            <p>foto de perfil</p>
          </div>
          <button @click="modalVisible = true">
            <svg
              class="w-6 h-6 text-white hover:text-green-400 cursor-pointer"
              fill="currentColor"
              viewBox="0 0 32 32"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M29.1,20.3L19.5,4.9C18.7,3.7,17.4,3,16,3s-2.7,0.7-3.5,1.9L2.9,20.3c-1.1,1.8-1.2,3.9-0.2,5.7c1,1.8,2.9,2.9,5,2.9h16.6  
            c2.1,0,4-1.1,5-2.9C30.3,24.2,30.2,22.1,29.1,20.3z M13.9,10.9c1-1.2,3.1-1.2,4.1,0c0.5,0.6,0.8,1.4,0.6,2.2l-0.7,5  
            c-0.1,0.5-0.5,0.9-1,0.9h-2c-0.5,0-0.9-0.4-1-0.9l-0.7-5C13.2,12.3,13.4,11.5,13.9,10.9z M16.5,25h-1c-1.4,0-2.5-1.1-2.5-2.5  
            s1.1-2.5,2.5-2.5h1c1.4,0,2.5,1.1,2.5,2.5S17.9,25,16.5,25z"
              />
            </svg>
          </button>
          <p>Denunciar Perfil de usuario</p>
        </div>

        <div class="border-t pt-4 space-y-2">
          <div class="flex justify-between">
            <p>Nombre</p>
            <p class="font-medium">{{ form.name }} {{ form.last_name }}</p>
          </div>
          <div class="flex justify-between">
            <p>Estado publicacion:</p>
            <p>{{ estadoNombre }}</p>
          </div>
          <div class="flex justify-between">
            <p>Rol</p>
            <p>{{ rolNombre }}</p>
          </div>
          <div class="flex justify-between">
            <p>Nivel</p>
            <p>{{ nivelNombre }}</p>
          </div>
          <div class="flex justify-between">
            <p>Puntos acumulados</p>
            <p>{{ form.cantidad_puntos }}</p>
          </div>
        </div>
      </div>

      <br />

      <!-- Información de contacto -->
      <div class="w-full backdrop-blur-sm rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Información de contacto</h2>

        <div class="space-y-2">
          <div class="flex justify-between">
            <p>Correo electrónico</p>
            <p class="font-medium">{{ form.email }}</p>
          </div>
          <div class="flex justify-between">
            <p>DPI</p>
            <p>{{ form.dpi ?? 'Sin DPI' }}</p>
          </div>
          <div class="flex justify-between">
            <p>Municipio</p>
            <p>{{ municipioNombre }}</p>
          </div>
          <div class="flex justify-between">
            <p>Dirección</p>
            <p class="max-w-sm text-right">{{ form.detalle_direccion ?? 'Sin dirección' }}</p>
          </div>
          <div class="flex justify-between">
            <p>Contacto</p>
            <p class="max-w-sm text-right">{{ form.medio_contacto ?? 'Sin contacto' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <DenunciaMod
    :show="modalVisible"
    :opciones="motivos"
    @close="modalVisible = false"
    @cargar-Denunci="crearDenuncia"
  />
</template>

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRoute } from 'vue-router'
import DenunciaMod from '@/views/reutilizador/DenunciaModalR.vue'

const form = ref({})
const estadoNombre = ref('')
const municipioNombre = ref('')
const nivelNombre = ref('')
const rolNombre = ref('')
const motivos = ref([])

const modalVisible = ref(false)

const error = ref('')

const user = ref('')
const id_user = ref('')

const route = useRoute()
const denuncia = ref({
  id_usuario_denunciado: null,
  id_usuario_denunciante: null,
  id_motivo_denuncia: null,
  id_estado_denuncia: 1,
})

onMounted(async () => {
  try {
    const res1 = await api.get(`/get_catalogos/motivo_denuncia`)
    motivos.value = res1.data
    const id = route.params.id
    if (!id) {
      //Mi perfil
      id_user.value = localStorage.getItem('id')
      const res = await api.get(`/uniqueuser/${id_user.value}`)
      console.log(res.data)
      form.value = res.data
      estadoNombre.value = res.data.estado?.nombre || 'Desconocido'
      municipioNombre.value = res.data.municipio?.nombre || 'Desconocido'
      nivelNombre.value = res.data.nivel?.nombre_nivel || 'Desconocido'
      rolNombre.value = res.data.rol?.nombre || 'Desconocido'
    } else {
      id_user.value = id
      const res = await api.get(`/userProfilebyPub/${id_user.value}`)
      console.log(res.data)
      form.value = res.data
      estadoNombre.value = res.data.estado?.nombre || 'Desconocido'
      municipioNombre.value = res.data.municipio?.nombre || 'Desconocido'
      nivelNombre.value = res.data.nivel?.nombre_nivel || 'Desconocido'
      rolNombre.value = res.data.rol?.nombre || 'Desconocido'
    }
  } catch (e) {
    console.error(e)
    error.value = 'Error al cargar datos del perfil'
  }
})

const crearDenuncia = async (motivo) => {
  modalVisible.value = false
  denuncia.value.id_usuario_denunciado = form.value.id
  denuncia.value.id_usuario_denunciante = localStorage.getItem('id')
  denuncia.value.id_motivo_denuncia = motivo
  // alert(`Denunciante ${denuncia.value.id_usuario_denunciante}`)
  try {
    const res = await api.post('/storeDenunciaProfile', denuncia.value)
    mensaje.value = res.data.message
  } catch (e) {
    error.value = e.response.data.message
  }
}
</script>
