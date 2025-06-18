<template>
 

  <div
    class="mt-32 w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
  >
    <!-- BARRA   categoriasss -->
    <div
      class="flex space-x-8 px-6 border-b-2 border-indigo-500 w-fit mx-auto text-sm font-semibold text-white"
    >
      <button @click="router.push('/recicla0te.com/reutilizador/pub')" class="pb-2 hover:border-b-2 hover:border-white">Articulo</button>
      <button @click="router.push('/recicla0te.com/reutilizador/pub/info_user')" class="pb-2 hover:border-b-2 hover:border-white">Sobre el Reutilizador</button>



    </div>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue'
import api from '../axios'
import { useRouter } from 'vue-router'

const router = useRouter()


onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'reutilizador') {
      router.push('/')
    } else {

    }
  } catch (e) {
    router.push('/')
  }
})



const cargarPublications = async () => {
    alert('Cargar publicaciones no implementado aún')
}



</script>