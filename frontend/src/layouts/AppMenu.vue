<template>
  <transition name="slide-down">
    <div class="app-menu" v-if="show" v-click-outside="handleOutsideClick">
      <div class="menu-content">
        <h2>Learning path</h2>
        <hr />
        <ul>
          <li><router-link to="/learning">Learning</router-link></li>
          <li><router-link to="/ranking">Ranking</router-link></li>
          <li><router-link to="/profile">Profile</router-link></li>
          <li><router-link to="/settings">Settings</router-link></li>
          <li><router-link to="/help">Help</router-link></li>
        </ul>
        <div class="logout">
          <router-link to="/">Log out</router-link>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
defineProps({ show: Boolean })
const emit = defineEmits(['close'])

function handleOutsideClick() {
  emit('close')
}
</script>

<style scoped>
.app-menu {
  position: absolute;
  top: 80px; /* ⚠️ exactement la hauteur du header */
  left: 0;
  width: 100%;
  background-color: rgba(255, 255, 255, 0.9); /* blanc 90% opaque */

  z-index: 10;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.menu-content {
  padding: 24px 16px;
}

h2 {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 16px;
}

hr {
  margin: 8px 0 16px;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

li {
  padding: 12px 0;
  border-bottom: 1px solid #ccc;
}

.logout {
  margin-top: 24px;
  font-weight: bold;
}

/* Animation */
.slide-down-enter-active,
.slide-down-leave-active {
  transition: all 0.3s ease;
}

.slide-down-enter-from,
.slide-down-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}
.learning-main {
  padding-top: 80px; /* pour ne pas que le contenu passe sous le header */
}
</style>
