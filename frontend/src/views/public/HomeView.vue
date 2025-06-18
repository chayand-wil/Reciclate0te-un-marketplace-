<template>
    <div
    class="mt-32 w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
  >
    <!-- BARRA   categoriasss -->
    <div
      class="flex space-x-8 px-6 border-b-2 border-indigo-500 w-fit mx-auto text-sm font-semibold text-white"
    >
      <button class="pb-2 border-b-2 border-indigo-500">Tailwind CLI</button>
      <button class="pb-2 hover:border-b-2 hover:border-white">Using PostCSS</button>
      <button class="pb-2 hover:border-b-2 hover:border-white">Framework Guides</button>
      <button class="pb-2 hover:border-b-2 hover:border-white">Play CDN</button>
    </div>


    
  </div>

  
  <div class="mt-10 mr-20 ml-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <PublicationCard
      v-for="item in publications"
      :key="item.id"
      :publication="item"
    />
  </div>


</template>

 

 

<script setup>
import { ref, onMounted } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'
import PublicationCard from '@/components/PublicationCard.vue'

const mensaje = ref('')
const error = ref('')

const router = useRouter()
const publications = ref([])

const publication = ref({
  id_articulo: null,
  imagen_url: null,
})

onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'reutilizador') {
      router.push('/')
    } else {
      await cargarPublications()
    }
  } catch (e) {
    router.push('/')
  }
})

const cargarPublications = async () => {
  try {
    const res = await api.get('/publications')
    publications.value = res.data
  } catch (e) {
    error.value = 'Error al cargar publicaciones'
  }
}
</script>





 <!-- {
        "id": 1,
        "id_usuario": 1,
        "id_articulo": 1,
        "imagen_url": "https://wp.salesforce.com/en-us/wp-content/uploads/sites/4/2024/07/production-resource-card-ALGO-720x405-1.png",
        "id_publicacion_visibilidad": 1,
        "cantidad_visualizaciones": 0,
        "created_at": null,
        "updated_at": null,
        "user": {
            "id": 1,
            "name": "Admin",
            "last_name": "Principal",
            "email": "admin@ejemplo.com",
            "dpi": "1234567890101",
            "id_estado": 1,
            "id_rol": 1,
            "id_nivel": 1,
            "cantidad_puntos": 0,
            "id_municipio": 1,
            "detalle_direccion": "Zona 1",
            "created_at": "2025-06-16T02:49:16.000000Z",
            "updated_at": "2025-06-16T02:49:16.000000Z",
            "email_verified_at": null
        },
        "article": {
            "id": 1,
            "nombre": "Bicicleta",
            "descripcion": "articulo de prueba",
            "detalles": "algoooooun detalle",
            "id_categoria_articulo": 2,
            "id_tipo_publico": 1,
            "calidad_articulo": 1,
            "estado_articulo": 1,
            "id_articulo_estado_adquisicion": 1
        }
    }, -->