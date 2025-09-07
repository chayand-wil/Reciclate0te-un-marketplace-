<!-- ModalComponent.vue -->
<template>
  <div v-if="modelValue" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-4 rounded shadow-md min-w-[300px]">
      <slot />
      <div class="mt-4 text-right">
        <button @click="$emit('update:modelValue', false)" class="bg-red-500 text-white px-4 py-2 rounded">
          Cerrar
        </button>
      </div>
    </div>
  </div>
</template>



<script setup>
defineProps({
  modelValue: Boolean
})

defineEmits(['update:modelValue'])
</script>
