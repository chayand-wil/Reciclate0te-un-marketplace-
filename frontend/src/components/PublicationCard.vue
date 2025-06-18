<template>
       <!-- Tarjeta de publicación -->
      <div class="bg-white/10 backdrop-blur-sm rounded-2xl shadow-lg text-white">
        <!-- Cabecera -->
        <div class="px-4 pt-4 flex justify-between items-center text-sm text-gray-400">
          <span>{{ publication.article.nombre }}</span>
          <p>{{ new Date(publication.created_at).toLocaleString() }}</p>

        </div>

        <!-- Descripción -->
        <div class="px-4 py-1 text-sm text-white">
          <p>{{ publication.description }}</p>
        </div>

        <!-- Imagen -->
        <div class="w-full">
          <img :src="publication.imagen_url" alt="Publicación" class="w-full h-64 object-cover" />
        </div>

        <!-- Estado -->
        <div class="mt-2 px-4 text-sm pb-1 text-green-400">
          Estado: {{ publication.article.estado_articulo }}
        </div>

        <!-- Acciones -->
        <div class="px-4 py-3 flex justify-between text-sm border-t border-gray-700">
          <button class="flex items-center space-x-1 hover:text-blue-400">
            <span>💬</span><span>Solicitar</span>
          </button>
 
          <button class="flex items-center space-x-1 hover:text-purple-400">
            <span>🔗</span><span>Compartir</span>
          </button>
        </div>
      </div>


</template>

<script setup>
defineProps({
  publication: {
    type: Object,
    required: true
  }
})
</script>
