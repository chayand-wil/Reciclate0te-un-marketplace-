import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../axios'

export function useRegistroUsuario() {
  const router = useRouter()

  const focus_name = ref(false)
  const focus_lastname = ref(false)
  const focus_mail = ref(false)
  const focus_password = ref(false)
  const focus_dpi = ref(false)
  const focus_direccion = ref(false)
  const focus_contacto = ref(false)

  const mensaje = ref('')
  const error = ref('')
  const municipios = ref([])

const nuevo = ref(getDefaultNuevo())

  const departamento = ref(1)

  const obtenerMunicipios = async () => {
    try {
      const res = await api.get(`/get_catalogos/municipio`)
      municipios.value = res.data
    } catch (e) {
      error.value = e.res?.message || 'Error al cargar municipios'
      router.push('/')
    }
  }

// Función para limpiar
function limpiarNuevo() {
  nuevo.value = getDefaultNuevo()
}

function getDefaultNuevo() {
  return {
    name: '',
    last_name: '',
    email: '',
    password: '',
    dpi: '',
    id_estado: 1,
    id_rol: 4,
    id_nivel: 1,
    cantidad_puntos: 0,
    id_municipio: 1,
    fecha_nacimiento: '',
    id_genero: 2,
    detalle_direccion: '',
    medio_contacto: '',
  }
}


  const crearUsuario = async () => {
    mensaje.value = ''
    error.value = ''
    try {
      const response = await api.post('/register', nuevo.value)
      if (response.status === 201) {
        mensaje.value = response.data.message
        setTimeout(() => (mensaje.value = ''), 2000)
        if(!localStorage.getItem('id')) {
          await login()
        } 
        limpiarNuevo()
      }
    } catch (e) {
      if (e.response?.status === 422) {
        const errores = e.response.data.errors
        error.value = ' Error: ' + Object.values(errores).flat().join(', ')
        setTimeout(() => {
          mensaje.value = ''
          error.value = ''
        }, 2000)
      }
    }
  }

  const login = async () => {
    try {
      const response = await api.post('/login', {
        email: nuevo.value.email,
        password: nuevo.value.password,
      })

      const token = response.data.access_token
      const role = response.data.user.rol.slug
      const id = response.data.user.id

      localStorage.setItem('token', token)
      localStorage.setItem('role', role)
      localStorage.setItem('id', id)

      switch (role) {
        case 'admin':
          router.push('/admin')
          break
        case 'bodeguero':
          router.push('/bodeguero')
          break
        case 'reutilizador':
          router.push('/reutilizador')
          break
        case 'clasificador':
          router.push('/clasificador')
          break
        default:
          router.push('/')
      }
    } catch {
      error.value = 'Credenciales incorrectas'
    }
  }

  onMounted(obtenerMunicipios)

  return {
    nuevo,
    mensaje,
    error,
    municipios,
    focus_name,
    focus_lastname,
    focus_mail,
    focus_password,
    focus_dpi,
    focus_direccion,
    focus_contacto,
    crearUsuario,
  }
}
