<template>
  <!-- Tarjeta de publicación -->
  <div class="bg-white/10 backdrop-blur-sm rounded-2xl shadow-lg text-white">
    <!-- Cabecera -->
    <div class="px-4 pt-4 flex justify-between items-center text-sm text-gray-400">
      <span>{{ publication.article.nombre }}</span>
      <p>{{ new Date(publication.created_at).toLocaleString() }}</p>
      <button @click="modalVisible = true">
        <svg
          class="w-5 h-5 text-white hover:text-green-400 cursor-pointer"
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
    </div>

    <!-- Descripción -->
    <div class="px-4 py-1 text-sm text-white">
      <p>{{ publication.description }}</p>
    </div>

    <!-- Imagen con overlay -->
    <div @click.stop="emitirDetalle" class="relative w-full group">
      <img
        :src="publication.imagen_url"
        alt="Publicación"
        class="w-full h-64 object-cover rounded cursor-pointer"
      />
      <div
        class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200"
      ></div>
    </div>

    <!-- Estado -->
    <div class="mt-2 px-4 text-sm pb-1 text-green-400">
      Estado: {{ publication.article.estado_adquisicion.nombre }}
    </div>

    <!-- Acciones -->
    <div class="px-4 py-3 flex justify-between text-sm border-t border-gray-700">
      <button @click="emitirDetalle" class="flex items-center space-x-1 hover:text-blue-400">
        Ver mas detalles
      </button>

      <button class="flex items-center space-x-1 hover:text-purple-400">
        <span></span><span>🔗 Compartir</span>
      </button>
    </div>
  </div>
  <DenunciaModal
    :show="modalVisible"
    :opciones="motivos"
    @close="modalVisible = false"
    @cargar-Denuncia="setConfiguracion"
  />
</template>

<script setup>
import { ref } from 'vue'
import DenunciaModal from '@/components/DenunciaModal.vue'
const { publication } = defineProps(['publication', 'motivos'])

const modalVisible = ref(false)
const emit = defineEmits(['cargar-Publication', 'crear-Denuncia'])

const id_publicacion = ref(false)
const id_motivo = ref(false)

function emitirDetalle() {
  emit('cargar-Publication', publication.id)
}

function setConfiguracion(id) {
  modalVisible.value = false
  emit('crear-Denuncia', publication.id, id)
}
</script>
