import axios from 'axios'
import router from './router'

const api = axios.create({
  baseURL: 'http://localhost:8000/api',
})

api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

export default api

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      localStorage.removeItem('token')
      localStorage.removeItem('role')
      router.push('/recicla0te.com/login') // Redirige correctamente
    }
    return Promise.reject(error)
  },
)
// Redirige a la página de login si el token es inválido o ha expirado
// Asegúrate de importar el router en este archivo si no lo has hecho ya
