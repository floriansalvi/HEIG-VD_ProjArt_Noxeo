import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/auth/Login.vue'
import RegisterStep1 from '@/views/auth/RegisterStep1.vue'
import RegisterStep2 from '@/views/auth/RegisterStep2.vue'
import Home from '@/views/Home.vue'
import Learning from '@/views/Learning.vue'
import Onboarding from '@/views/learning/Onboarding.vue'
import Discovery from '@/views/learning/Discovery.vue'
import Novelties from '@/views/learning/Novelties.vue'

const routes = [
  { path: '/', name: 'Login', component: Login },
  { path: '/register', name: 'Register1', component: RegisterStep1 },
  { path: '/register-step-2', name: 'Register2', component: RegisterStep2 },
  { path: '/home', name: 'home', component: Home },
  { path: '/learning', name: 'learning', component: Learning },
  { path: '/learning/onboarding', name: 'onboarding', component: Onboarding },
  { path: '/learning/discovery', name: 'discovery', component: Discovery },
  { path: '/learning/novelties', name: 'novelties', component: Novelties },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
