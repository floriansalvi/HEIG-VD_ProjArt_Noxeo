import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
// import vueDevTools from 'vite-plugin-vue-devtools' // ⬅️ commenté

export default defineConfig({
  plugins: [
    vue(),
    // vueDevTools() // ⬅️ commenté
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url)),
    },
  },
  server: {
    proxy: {
      '/api': {
        target: 'http://localhost:8000',
        changeOrigin: true,
        secure: false,
      },
      '@assets': fileURLToPath(new URL('./src/assets', import.meta.url)),
    },
  },
})
