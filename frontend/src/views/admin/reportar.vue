<template>
  <div class="w-full mt-24 max-w-4xl bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-lg mb-6">
    <div class="p-4 text-black space-y-6">
      <h1 class="text-2xl font-bold">Reportes</h1>

      <div v-if="error" class="text-red-500">{{ error }}</div>

      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Total usuarios -->
        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Total de usuarios</h2>
          <p class="text-xl">{{ usuarios.length }}</p>
        </div>

        <!-- Total publicaciones -->
        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Total de publicaciones</h2>
          <p class="text-xl">{{ publicaciones.length }}</p>
        </div>

        <!-- Promedio de puntos -->
        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Promedio de puntos por usuario</h2>
          <p class="text-xl">{{ promedioPuntos.toFixed(2) }}</p>
        </div>

        <!-- Publicaciones por usuario -->
        <div class="bg-white p-4 rounded shadow col-span-1 md:col-span-2">
          <h2 class="text-lg font-semibold">Publicaciones por usuario</h2>
          <ul class="list-disc pl-4">
            <li v-for="(count, name) in publicacionesPorUsuario" :key="name">
              {{ name }}: {{ count }}
            </li>
          </ul>
        </div>

        <!-- Publicaciones por categoría -->
        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Publicaciones por categoría</h2>
          <ul class="list-disc pl-4">
            <li v-for="(count, categoria) in publicacionesPorCategoria" :key="categoria">
              {{ categoria }}: {{ count }}
            </li>
          </ul>
        </div>

        <!-- Publicaciones por estado de adquisición -->
        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Publicaciones por estado de adquisición</h2>
          <ul class="list-disc pl-4">
            <li v-for="(count, estado) in publicacionesPorEstadoAdquisicion" :key="estado">
              {{ estado }}: {{ count }}
            </li>
          </ul>
        </div>

        <!-- Usuarios por rol -->
        <div class="bg-white p-4 rounded shadow">
          <h2 class="text-lg font-semibold">Usuarios por rol</h2>
          <ul class="list-disc pl-4">
            <li v-for="(count, rol) in usuariosPorRol" :key="rol">{{ rol }}: {{ count }}</li>
          </ul>
        </div>

        <!-- Top 5 publicaciones más vistas -->
        <div class="bg-white p-4 rounded shadow col-span-1 md:col-span-2 xl:col-span-3">
          <h2 class="text-lg font-semibold">Top 5 publicaciones más vistas</h2>
          <ol class="list-decimal pl-4">
            <li v-for="pub in publicacionesMasVistas" :key="pub.id">
              {{ pub.nombre }} ({{ pub.cantidad_visualizaciones }} vistas)
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import api from '../../axios'

const error = ref('')
const usuarios = ref([])
const publicaciones = ref([])

onMounted(async () => {
  try {
    const res1 = await api.get('/getUserAllFields')
    usuarios.value = res1.data

    const res2 = await api.get('/publications')
    publicaciones.value = res2.data
  } catch (e) {
    console.error(e)
    error.value = 'Error al cargar los datos'
  }
})

// Publicaciones por usuario
const publicacionesPorUsuario = computed(() => {
  const conteo = {}
  publicaciones.value.forEach((pub) => {
    const usuario = usuarios.value.find((u) => u.id === pub.id_usuario)
    if (usuario) {
      const nombreCompleto = `${usuario.name} ${usuario.last_name}`
      conteo[nombreCompleto] = (conteo[nombreCompleto] || 0) + 1
    }
  })
  return conteo
})

// Publicaciones por categoría
const publicacionesPorCategoria = computed(() => {
  const conteo = {}
  publicaciones.value.forEach((pub) => {
    const nombreCategoria = pub.article?.categoria?.nombre || 'Sin categoría'
    conteo[nombreCategoria] = (conteo[nombreCategoria] || 0) + 1
  })
  return conteo
})

// Publicaciones por estado de adquisición
const publicacionesPorEstadoAdquisicion = computed(() => {
  const conteo = {}
  publicaciones.value.forEach((pub) => {
    const estado = pub.article?.estado_adquisicion?.nombre || 'Desconocido'
    conteo[estado] = (conteo[estado] || 0) + 1
  })
  return conteo
})

// Usuarios por rol
const usuariosPorRol = computed(() => {
  const conteo = {}
  usuarios.value.forEach((user) => {
    const rol = user.rol?.nombre || 'Sin rol'
    conteo[rol] = (conteo[rol] || 0) + 1
  })
  return conteo
})

// Promedio de puntos
const promedioPuntos = computed(() => {
  if (usuarios.value.length === 0) return 0
  const total = usuarios.value.reduce((acc, u) => acc + (u.cantidad_puntos || 0), 0)
  return total / usuarios.value.length
})

// Publicaciones más vistas (top 5)
const publicacionesMasVistas = computed(() => {
  return [...publicaciones.value]
    .sort((a, b) => b.cantidad_visualizaciones - a.cantidad_visualizaciones)
    .slice(0, 5)
})
</script>
