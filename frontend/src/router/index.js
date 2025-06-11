import { createRouter, createWebHistory } from 'vue-router'
import auth from '@/services/auth.js'

import Login from '@/views/auth/Login.vue'
import RegisterStep1 from '@/views/auth/RegisterStep1.vue'
import RegisterStep2 from '@/views/auth/RegisterStep2.vue'
import LearningPath from '@/views/LearningPathPage/LearningPath.vue'
import Learning from '@/views/LearningPage/Learning.vue'
import LearningCategory from '@/views/LearningPage/LearningCategory.vue'
import Terms from '@/views/static/Terms.vue'
import Privacy from '@/views/static/Privacy.vue'
import Ranking from '@/views/RankingPage/Ranking.vue'
import Profile from '@/views/ProfilePage/Profile.vue'
import Settings from '@/views/SettingsPage/Settings.vue'
import LearningModule from '@/views/LearningPage/LearningModule.vue'
import Error404 from '@/views/Error404.vue'

const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login,
    meta: { requiresGuest: true }
  },
  {
    path: '/key',
    name: 'Register1',
    component: RegisterStep1,
    meta: { requiresGuest: true }
  },
  {
    path: '/register',
    name: 'Register2',
    component: RegisterStep2,
    meta: { requiresGuest: true }
  },
  {
    path: '/verify-email',
    name: 'VerifyEmail',
    component: () => import('@/views/auth/VerifyEmail.vue'),
    meta: { requiresAuth: true, requiresUnverifiedEmail: true }
  },
  {
    path: '/learning-path',
    name: 'LearningPath',
    component: LearningPath,
    meta: { requiresAuth: true, requiresVerifiedEmail: true }
  },
  {
    path: '/learning',
    name: 'learning',
    component: Learning,
    meta: { requiresAuth: true, requiresVerifiedEmail: true }
  },
  {
    path: '/learning/:id',
    name: 'LearningCategory',
    component: LearningCategory,
    meta: { requiresAuth: true, requiresVerifiedEmail: true },
    props: true
  },
  {
    path: '/learning/module/:id',
    name: 'ModuleDetail',
    component: LearningModule,
    meta: { requiresAuth: true, requiresVerifiedEmail: true },
    props: true
  },
  {
    path: '/terms',
    name: 'terms',
    component: Terms
  },
  {
    path: '/privacy',
    name: 'privacy',
    component: Privacy
  },
  {
    path: '/ranking',
    name: 'ranking',
    component: Ranking,
    meta: { requiresAuth: true, requiresVerifiedEmail: true }
  },
  {
    path: '/profile',
    name: 'profile',
    component: Profile,
    meta: { requiresAuth: true, requiresVerifiedEmail: true }
  },
  {
    path: '/settings',
    name: 'settings',
    component: Settings,
    meta: { requiresAuth: true, requiresVerifiedEmail: true }
  },
  {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component : Error404
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach(async (to, from, next) => {
    // Make sure user data is loaded before any auth check
    if (auth.user.value === null && to.meta.requiresAuth !== false) {
        await auth.fetchUser();
    }

    const isAuth = auth.isAuthenticated.value;
    const isVerified = auth.emailVerified.value;
    const hasRegistrationKey = sessionStorage.getItem('registration_key') !== null;

    // Redirect authenticated users away from guest-only routes (like login/register)
    if (to.meta.requiresGuest && isAuth) {
        return next('/learning-path');
    }

    // If route requires auth but user is not authenticated, redirect to login
    if (to.meta.requiresAuth && !isAuth) {
        return next('/');
    }

    // If route is only for users with unverified emails, but the email is already verified, redirect
    if (to.meta.requiresUnverifiedEmail && isAuth && isVerified) {
        return next('/learning-path');
    }

    // If route requires a verified email but user is not verified, redirect to verification page
    if (to.meta.requiresVerifiedEmail && (!isAuth || !isVerified)) {
        return next('/verify-email');
    }

    // If route requires a valid registration key but none is stored, redirect to registration step 1
    if (to.meta.requiresRegistrationKey && !hasRegistrationKey) {
        return next('/key');
    }

    // All checks passed, allow route access
    return next();
});

export default router
