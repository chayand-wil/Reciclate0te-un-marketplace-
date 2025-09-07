<template>
  <div class="mt-40">
    <button class="bg-blue-600 text-white px-4 py-2 rounded" @click="modalVisible = true">
      Abrir Modal
    </button>

    <hijo :show="modalVisible" @close="modalVisible = false" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import hijo from './hijo.vue'

const modalVisible = ref(false)
</script>
