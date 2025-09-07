<template>
  <div
    v-if="show"
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
  >
    <div class="bg-zinc-900 text-white p-6 rounded-lg w-full max-w-md shadow-lg">
      <!-- Header -->
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-bold">Reportar</h2>
        <button @click="$emit('close')" class="text-white text-xl">&times;</button>
      </div>

      <p class="text-sm text-gray-300 mb-4">
        Vas a enviar un reporte<br />
        <span class="text-gray-400">
          Solo eliminamos contenido que infringe nuestras
          <a href="#" class="text-blue-400 underline">Normas comunitarias</a>.
        </span>
      </p>

      <!-- Opciones -->
      <div class="space-y-2 mb-6">
        <p class="text-sm text-gray-400">¿Por qué quieres reportar esta foto?</p>

        <div
          v-for="(opcion, index) in opciones"
          :key="index"
          @click="seleccionada = opcion"
          :class="[
            'cursor-pointer p-3 rounded-lg border transition-all',
            seleccionada === opcion
              ? 'bg-zinc-700 border-purple-500 text-white'
              : 'bg-zinc-800 border-zinc-600 text-gray-300',
          ]"
        >
          {{ opcion }}
        </div>
      </div>

      <!-- Botón Enviar -->
      <button
        :disabled="!seleccionada"
        class="w-full bg-purple-600 hover:bg-purple-700 transition-all text-white py-2 rounded disabled:opacity-50"
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
})

const emit = defineEmits(['close'])

const opciones = [
  'Contenido violento o explícito',
  'Problema que involucra a un menor de 18 años',
  'Contenido de odio o discriminación',
  'Desnudez o actividad sexual',
]

const seleccionada = ref('')
</script>
