import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  base: '/admin/',
  server: {
    proxy: {
      '/api': {
        target: 'http://localhost:8000', // Redirige las peticiones API en local
        changeOrigin: true
      }
    }
  }
})
