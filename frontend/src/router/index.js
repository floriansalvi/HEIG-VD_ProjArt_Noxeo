import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/auth/Login.vue'
import RegisterStep1 from '@/views/auth/RegisterStep1.vue'
import RegisterStep2 from '@/views/auth/RegisterStep2.vue'
import LearningPath from '@/views/LearningPathPage/LearningPath.vue'
import Learning from '@/views/LearningPage/Learning.vue'
import Onboarding from '@/views/LearningPage/LearningCategory/Onboarding.vue'
import Discovery from '@/views/LearningPage/LearningCategory/Discovery.vue'
import Novelties from '@/views/LearningPage/LearningCategory/Novelties.vue'
import Terms from '@/views/static/Terms.vue'
import Privacy from '@/views/static/Privacy.vue'
import Ranking from '@/views/RankingPage/Ranking.vue'
import Profile from '@/views/ProfilePage/Profile.vue'
import Settings from '@/views/SettingsPage/Settings.vue'

const routes = [
  { path: '/', name: 'Login', component: Login },
  { path: '/register', name: 'Register1', component: RegisterStep1 },
  { path: '/register-step-2', name: 'Register2', component: RegisterStep2 },
  { path: '/learning-path', name: 'LearningPath', component: LearningPath },
  { path: '/learning', name: 'learning', component: Learning },
  { path: '/learning/onboarding', name: 'onboarding', component: Onboarding },
  { path: '/learning/discovery', name: 'discovery', component: Discovery },
  { path: '/learning/novelties', name: 'novelties', component: Novelties },
  { path: '/terms', name: 'terms', component: Terms },
  { path: '/privacy', name: 'privacy', component: Privacy },
  { path: '/ranking', name: 'ranking', component: Ranking },
  { path: '/profile', name: 'profile', component: Profile },
  { path: '/settings', name: 'settings', component: Settings },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
