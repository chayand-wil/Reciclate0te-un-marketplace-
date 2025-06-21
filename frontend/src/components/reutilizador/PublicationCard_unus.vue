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
      >
        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" viewBox="0 0 20 20" fill="currentColor">
      <path d="M4 3a2 2 0 00-2 2v2h2V5h2V3H4zM14 3v2h2v2h2V5a2 2 0 00-2-2h-2zM2 14v2a2 2 0 002 2h2v-2H4v-2H2zm16 0v2h-2v2h2a2 2 0 002-2v-2h-2z" />
    </svg> -->
        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    d="M3 7h2l2-3h10l2 3h2a2 2 0 012 2v10a2 2 0 01-2 2H3a2 2 0 01-2-2V9a2 2 0 012-2zm9 3a4 4 0 100 8 4 4 0 000-8z" />
</svg> -->
      </div>
    </div>

    <!-- Estado -->
    <div class="mt-2 px-4 text-sm pb-1 text-green-400">
      Estado: {{ publication.article.estado_articulo }}
    </div>
  
  </div>
</template>

<script setup>
const { publication } = defineProps(['publication'])
const emit = defineEmits(['cargar-Publication'])

function emitirDetalle() {
  emit('cargar-Publication', publication.id)
}

const handleImageClick = () => {
  alert('Imagen clickeada: ' + publication.id)
  // Aquí podrías abrir un modal, lanzar un input de archivo, etc.
}
</script>
