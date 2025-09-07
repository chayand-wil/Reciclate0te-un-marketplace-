<template>
 
  
  <div class="mt-10 mr-24 ml-24 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-8">
    <PublicationCard v-for="item in publications" :key="item.id" :publication="item" 
    @cargar-Publication="cargarPublication"
    />
  </div>
   
</template>

 

<script setup>
import {  ref, onMounted } from 'vue'
import api from '../../../axios'
import { useRouter } from 'vue-router'
import PublicationCard from '@/components/PublicationCard.vue'

// Usuario ref for passing to PublicationView
const usuario = ref(null)
 
const mensaje = ref('')
const error = ref('')
const emit = defineEmits(['cargarPublication'])

const router = useRouter()
const publications = ref([])
 

onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'reutilizador') {
      router.push('/')
      alert('No tienes permisos para acceder a esta sección')
    } else {
      usuario.value = res.data
      await cargarPublications()
    }
  } catch (e) {
    router.push('/')
  }
})

const cargarPublications = async () => {
  try {
    const res = await api.get(`/publications/${usuario.value.id}`)
    publications.value = res.data
  } catch (e) {
    error.value = 'Error al cargar publicaciones'
  }
}

const cargarPublication = async (id) => {
  router.push({ name: 'pub', params: { id } })
}


</script>

