<template>
    <div class="mt-16 w-full max-w-2xl bg-white/10 backdrop-blur-sm rounded-2xl p-10 shadow-lg text-black">
    <!-- Información básica -->
    <div class="backdrop-blur-sm rounded-2xl shadow p-6">
      <h2 class="text-lg font-semibold mb-4     ">Información básica</h2>
      <p class="text-sm  mb-4">
        Es posible que otros usuarios puedan ver parte de la información en la plataforma.
      </p>

      <div class="flex items-center space-x-4 mb-4">
        <img
          src="../../../public/icono_user.png"
          alt="Foto de perfil"
          class="w-16 h-16 rounded-full object-cover"
        />
        <div>
          <p class="text-sm ">Imagen de perfil</p>
          <p class="">Una foto de perfil ayuda a personalizar tu cuenta</p>
        </div>
      </div>

      <div class="border-t pt-4 space-y-2">
        <div class="flex justify-between">
          <p class="">Nombre</p>
          <p class=" font-medium">{{ form.name }} {{ form.last_name }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Estado</p>
          <p class="">{{ estadoNombre }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Rol</p>
          <p class="">{{ rolNombre }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Nivel</p>
          <p class="">{{ nivelNombre }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Puntos acumulados</p>
          <p class="">{{ form.cantidad_puntos }}</p>
        </div>
      </div>
    </div>
<br>
    <!-- Información de contacto -->
    <div class="w-full backdrop-blur-sm rounded-2xl shadow p-6">
      <h2 class="text-lg font-semibold mb-4 ">Información de contacto</h2>

      <div class="space-y-2">
        <div class="flex justify-between">
          <p class="">Correo electrónico</p>
          <p class=" font-medium">{{ form.email }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">DPI</p>
          <p class="">{{ form.dpi ?? 'Sin DPI' }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Municipio</p>
          <p class="">{{ municipioNombre }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Dirección</p>
          <p class=" max-w-sm text-right">{{ form.detalle_direccion ?? 'Sin dirección' }}</p>
        </div>
        <div class="flex justify-between">
          <p class="">Contacto</p>
          <p class=" max-w-sm text-right">{{ form.contacto ?? 'Sin contacto' }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const estados = ref([{ id: 1, nombre: 'Activo' }, { id: 2, nombre: 'Inactivo' }])
const roles = ref([{ id: 1, nombre: 'Usuario' }, { id: 2, nombre: 'Administrador' }])
const niveles = ref([{ id: 1, nombre: 'Básico' }, { id: 2, nombre: 'Avanzado' }])
const municipios = ref([{ id: 1, nombre: 'Quetzaltenango' }, { id: 2, nombre: 'Olintepeque' }])

const form = ref({
  name: 'Wilson Jonatan',
  last_name: 'Chay Santizo',
  email: 'wilsonchay201830530@cunoc.edu.gt',
  password: '',
  dpi: '1234567890101',
  id_estado: 1,
  id_rol: 2,
  id_nivel: 1,
  cantidad_puntos: 120,
  id_municipio: 1,
  detalle_direccion: 'Zona 8, frente a parque central',
  contacto: '4567-8910 / wilson@email.com',
})

// Get name from IDs
const estadoNombre = computed(() =>
  estados.value.find(e => e.id === form.value.id_estado)?.nombre ?? 'Sin estado'
)
const rolNombre = computed(() =>
  roles.value.find(r => r.id === form.value.id_rol)?.nombre ?? 'Sin rol'
)
const nivelNombre = computed(() =>
  niveles.value.find(n => n.id === form.value.id_nivel)?.nombre ?? 'Sin nivel'
)
const municipioNombre = computed(() =>
  municipios.value.find(m => m.id === form.value.id_municipio)?.nombre ?? 'Sin municipio'
)
</script>
