import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './css/index.css' // ton fichier CSS global

createApp(App).use(router).mount('#app')
