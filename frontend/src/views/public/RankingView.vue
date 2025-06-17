<template>

  <div>

  <form @submit.prevent="handleSubmit">
    <h2>Crear Artículo y Publicación</h2>

    <!-- Artículo -->
    <div>
      <label>Nombre:</label>
      <input v-model="form.nombre" type="text" maxlength="100" required />
    </div>

    <div>
      <label>Descripción:</label>
      <textarea v-model="form.descripcion" required></textarea>
    </div>

    <div>
      <label>Detalles:</label>
      <textarea v-model="form.detalles" required></textarea>
    </div>

    <!-- Selects relacionados al artículo -->
    <div>
      <label>Categoría:</label>
      <select v-model="form.id_categoria_articulo" required>
        <option disabled value="">Seleccione una categoría</option>
        <option v-for="cat in categorias" :key="cat.id" :value="cat.id">
          {{ cat.nombre }}
        </option>
      </select>
    </div>

    <div>
      <label>Tipo de público:</label>
      <select v-model="form.id_tipo_publico" required>
        <option disabled value="">Seleccione un tipo</option>
        <option v-for="tipo in tiposPublico" :key="tipo.id" :value="tipo.id">
          {{ tipo.nombre }}
        </option>
      </select>
    </div>

    <div>
      <label>Calidad del artículo:</label>
      <select v-model="form.calidad_articulo" required>
        <option disabled value="">Seleccione calidad</option>
        <option v-for="calidad in calidadesArticulo" :key="calidad.id" :value="calidad.id">
          {{ calidad.nombre }}
        </option>
      </select>
    </div>

    <div>
      <label>Estado del artículo:</label>
      <select v-model="form.estado_articulo" required>
        <option disabled value="">Seleccione estado</option>
        <option v-for="estado in estadosArticulo" :key="estado.id" :value="estado.id">
          {{ estado.nombre }}
        </option>
      </select>
    </div>

    <div>
      <label>Estado de adquisición:</label>
      <select v-model="form.id_articulo_estado_adquisicion" required>
        <option disabled value="">Seleccione una opción</option>
        <option v-for="estado in estadosAdquisicion" :key="estado.id" :value="estado.id">
          {{ estado.nombre }}
        </option>
      </select>
    </div>

    <!-- Publicación -->
    <div class=" text-verdee">
      <label>URL de imagen:</label>
      <input class=" text-verdee" v-model="form.imagen_url" type="text" required />
    </div>

    <div>
      <label>Visibilidad:</label>
      <select v-model="form.id_publicacion_visibilidad" required>
        <option disabled value="">Seleccione visibilidad</option>
        <option v-for="vis in visibilidades" :key="vis.id" :value="vis.id">
          {{ vis.nombre }}
        </option>
      </select>
    </div>

    <!-- Botón -->
    <button type="submit">Guardar</button>
  </form>

    
  </div>
</template>

<script setup>
import { ref } from 'vue'

const form = ref({
  nombre: '',
  descripcion: '',
  detalles: '',
  id_categoria_articulo: '',
  id_tipo_publico: '',
  calidad_articulo: '',
  estado_articulo: '',
  id_articulo_estado_adquisicion: '',
  imagen_url: '',
  id_publicacion_visibilidad: '',
})

// Datos simulados (en producción vienen de una API)
const categorias = ref([{ id: 1, nombre: 'Electrónica' }])
const tiposPublico = ref([{ id: 1, nombre: 'Adulto' }])
const calidadesArticulo = ref([{ id: 1, nombre: 'Nuevo' }])
const estadosArticulo = ref([{ id: 1, nombre: 'Disponible' }])
const estadosAdquisicion = ref([{ id: 1, nombre: 'Comprado' }])
const visibilidades = ref([{ id: 1, nombre: 'Público' }])

const handleSubmit = () => {
  console.log('Formulario enviado:', form.value)
  // Aquí harías un POST con Axios o Fetch
}
</script>

<style scoped>
form {
  max-width: 600px;
  margin: auto;
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
label {
  font-weight: bold;
}
input, select, textarea {
  width: 100%;
  padding: 0.5em;
}
button {
  padding: 0.7em;
}
</style>
