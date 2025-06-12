<template>
  <Transition name="slide-down">
    <div v-if="show" class="menu-panel">
      <ul class="menu-list">
        <li>
          <RouterLink to="/learning-path" @click="emit('close')"
            >Learning path</RouterLink
          >
        </li>
        <li>
          <RouterLink to="/learning" @click="emit('close')"
            >Learning</RouterLink
          >
        </li>
        <li>
          <RouterLink to="/ranking" @click="emit('close')">Ranking</RouterLink>
        </li>
        <li>
          <RouterLink to="/profile" @click="emit('close')">Profile</RouterLink>
        </li>
        <li>
          <RouterLink to="/settings" @click="emit('close')"
            >Settings</RouterLink
          >
        </li>
        <li>
          <RouterLink to="/help" @click="emit('close')">Help</RouterLink></li>
        <li>
          <p @click="logout">Log out</p>
        </li>
      </ul>
    </div>
  </Transition>
</template>

<script setup>
import { watch, onUnmounted } from 'vue'
import auth from '@/services/auth'
import { useRouter } from 'vue-router'

const router = useRouter()

const props = defineProps({ show: Boolean })
const emit = defineEmits(['close'])

const logout = async () => {
  await auth.logout()
  router.push('/')
}

watch(
  () => props.show,
  (visible) => {
    document.body.style.overflow = visible ? 'hidden' : ''
  }
)

onUnmounted(() => {
  document.body.style.overflow = ''
})
</script>

<style scoped>
/* Animation */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease;
}

.slide-down-enter-from,
.slide-down-leave-to {
  transform: translateY(-100%);
  opacity: 0;
}

/* Nouveau style de menu */
.menu-panel {
  position: fixed;
  top: 110px;
  left: 0;
  width: 100%;

  backdrop-filter: blur(12px);
  background-color: rgba(255, 255, 255, 0.65);
  z-index: 100;
  overflow-y: auto;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Style des liens */
.menu-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

.menu-list li {
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  padding: 16px;
  font-size: 1rem;

  p {
    margin: 0;
    font-size: 1rem;
    cursor: pointer;
  }
}

.menu-list a {
  text-decoration: none;
  color: #111;
  font-weight: 500;
  display: block;
}
</style>
