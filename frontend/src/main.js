import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axiosClient from './axios'
import './css/index.css' // ton fichier CSS global

const app = createApp(App)
app.use(router)

// Add axiosClient instance as a global property `$http` on the app,
app.config.globalProperties.$http = axiosClient;

// Provide axiosClient instance under the key `$http` for injection in setup() functions.
app.provide('$http', axiosClient)

app.mount('#app')

