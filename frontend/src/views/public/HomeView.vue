<template>
  <div class="fixed top-20 right-40 z-50 space-y-4 w-[300px]">
    <!-- Mensaje de éxito -->
    <div
      v-if="mensaje"
      class="bg-white/20 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-xl text-verdee"
    >
      {{ mensaje }}
    </div>

    <!-- Mensaje de error de validación -->
    <div
      v-if="error"
      class="bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-xl text-red-600"
    >
      {{ error }}
    </div>
  </div>

  <div class="mt-36 mb-10 flex items-center justify-center">
    <div
      class="w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-white"
    >
      <!-- BARRA DE CATEGORÍAS -->
      <div
        class="flex space-x-8 px-6 border-b-2 border-indigo-500 w-fit mx-auto text-sm font-semibold text-white"
      >
        <button class="pb-2 border-b-2 border-indigo-500">Tecnologia</button>
        <button class="pb-2 hover:border-b-2 hover:border-white">Ropa</button>
        <button class="pb-2 hover:border-b-2 hover:border-white">Muebles</button>
      </div>
    </div>
  </div>

  <div class="mt-1 mb-10 flex items-center justify-center">
    <h1 class="text-4xl md:text-5xl font-bold mb-6">Lo mas nuevo</h1>
  </div>
  <div class="mr-10 ml-10 overflow-x-auto whitespace-nowrap px-6">
    <div class="inline-flex gap-4">
      <PublicationCard
        v-for="item in publications"
        :key="item.id"
        :publication="item"
        :motivos="motivos"
        @cargar-Publication="cargarPublication"
        @crear-Denuncia="crearDenuncia"
        class="w-72 flex-shrink-0"
      />
    </div>
  </div>

  <br />
  <br />
  <br />
  <!-- <div class="mr-24 ml-24 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-8">
    <PublicationCard
      v-for="item in publications"
      :key="item.id"
      :publication="item"
      :motivos="motivos"
      @cargar-Publication="cargarPublication"
      @crear-Denuncia="crearDenuncia"
    />
  </div> -->

  <h2>Sobre Tecnologia</h2>
  <div class="mr-24 ml-24 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-8">
    <PublicationCard
      v-for="item in publications_tecno"
      :key="item.id"
      :publication="item"
      :motivos="motivos"
      @cargar-Publication="cargarPublication"
      @crear-Denuncia="crearDenuncia"
    />
  </div>
</template>

<script setup>
import { inject, ref, onMounted } from 'vue'
import api from '../../axios'
import { useRouter } from 'vue-router'
import PublicationCard from '@/components/PublicationCard.vue'

// Usuario ref for passing to PublicationView
const usuario = ref(null)

const mensaje = ref('')
const error = ref('')
const motivos = ref([])

// const emit = defineEmits(['cargarPublication'])

const router = useRouter()
const publications = ref([])
const publications_nuevo = ref([])
const publications_ecoemp = ref([])
const publications_peques = ref([])
const publications_tecno = ref([])

const denuncia = ref({
  id_usuario: null,
  id_publicacion: null,
  id_motivo_denuncia: null,
  id_estado_denuncia: 1,
})

onMounted(async () => {
  try {
    const res = await api.get('/me')
    if (res.data.rol.slug !== 'reutilizador') {
      router.push('/')
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
    const res = await api.get('/publications')
    publications.value = res.data
    console.log(publications.value)
    const res1 = await api.get(`/get_catalogos/motivo_denuncia`)
    motivos.value = res1.data

    //filtrar
    filtrar()
  } catch (e) {
    error.value = 'Error al cargar publicaciones'
  }
}

function filtrar() {
  for (let i = 0; i < publications.value.length; i++) {
    const pub = publications.value[i]
    if (pub.article.categoria.slug === 'tecno') {
      publications_tecno.value.push(pub)
    }
  }
}

const cargarPublication = async (id) => {
  router.push({ name: 'pub', params: { id } })
}

const crearDenuncia = async (pub_id, motivo) => {
  denuncia.value.id_usuario = usuario.value.id
  denuncia.value.id_publicacion = pub_id
  denuncia.value.id_motivo_denuncia = motivo
  try {
    const res = await api.post('/storeDenunciaPub', denuncia.value)
    mensaje.value = res.data.message
  } catch (e) {
    error.value = e.response.data.message
  }
}
</script>
