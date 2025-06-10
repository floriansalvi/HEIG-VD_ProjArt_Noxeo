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
        <li><RouterLink to="/help" @click="emit('close')">Help</RouterLink></li>
        <li>
          <RouterLink to="/logout" @click="emit('close')">Log out</RouterLink>
        </li>
      </ul>
    </div>
  </Transition>
</template>

<script setup>
import { watch, onUnmounted } from 'vue'

const props = defineProps({ show: Boolean })
const emit = defineEmits(['close'])

// Désactive le scroll quand le menu est visible
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
/* Slide depuis le haut */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease;
}

.slide-down-enter-from,
.slide-down-leave-to {
  transform: translateY(-100%);
  opacity: 0;
}

/* Menu sous le header */
.menu-panel {
  position: fixed;
  top: 110px; /* hauteur exacte du header */
  left: 0;
  width: 100%;
  background-color: rgb(219, 219, 219);
  z-index: 100;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Menu list style */
.menu-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.menu-list li {
  border-bottom: 1px solid #808080;
  padding: 16px;
  font-size: 1rem;
}

.menu-list a {
  text-decoration: none;
  color: #222;
  display: block;
}
</style>
