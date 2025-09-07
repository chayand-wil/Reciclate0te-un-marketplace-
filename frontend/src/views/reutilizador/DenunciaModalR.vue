<template>
  <div
    v-if="show"
    class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50"
  >
    <div class="bg-gray-600 text-white p-6 rounded-lg w-full max-w-md">
      <!-- Header -->
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold">Reportar Publicacion</h2>
        <button @click="$emit('close')" class="text-white text-xl">&times;</button>
      </div>

      <p class="text-sm text-black mb-4">
        Vas a enviar un reporte<br />
        <span class="text-gray-400"> <a href="#" class="">Normas comunitarias</a>. </span>
      </p>

      <!-- Opciones -->
      <div class="space-y-2 mb-6">
        <p class="text-sm text-gray-400">
          Selecciona el motivo por qué quieres reportar esta publicación?
        </p>

        <div
          v-for="opcion in opciones"
          :key="opcion.id"
          @click="seleccionada = opcion"
          :class="[
            'cursor-pointer p-3 rounded-lg border transition-all',
            seleccionada?.id === opcion.id ? 'bg-black' : 'bg-verdee',
          ]"
        >
          {{ opcion.nombre }}
        </div>
      </div>

      <!-- Botón Enviar -->
      <button
        :disabled="!seleccionada"
        class="w-full bg-black hover:bg-gray-700 transition-all text-white py-2 rounded disabled:opacity-50"
        @click="algo"
      >
        Enviar
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
defineProps({
  show: Boolean,
  opciones: {
    type: Array,
    required: true,
  },
})

const emit = defineEmits(['close', 'cargar-Denunci'])

const seleccionada = ref('')

function algo() {
  emit('cargar-Denunci', seleccionada.value.id)
}
</script>
