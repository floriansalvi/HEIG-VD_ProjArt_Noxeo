<template>
  <div class="home-learning">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <main class="learning-main">
      <h1 class="title">Learning path</h1>
      <p class="subtitle">scroll your path !</p>

      <div class="timeline-container">
        <div class="module">
          <h2>History</h2>
          <p class="meta">Onboarding · 1000PTS</p>
          <p class="desc">
            In this module, you'll discover the rich history of Breitling from
            its founding in 1884 to its key innovations and iconic moments.
          </p>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'

const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}
</script>

<style scoped>
.home-learning {
  background-color: white;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  position: relative;
}

.learning-main {
  padding: 24px 16px;
  flex: 1;
  margin-top: 80px; /* pour laisser la place au header */
}

.title {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 4px;
}

.subtitle {
  color: #666;
  margin-bottom: 24px;
}

.timeline-container {
  position: relative;
  overflow-x: hidden;
}

.module {
  margin-top: 0;
  position: relative;
  z-index: 2;
  padding: 24px 16px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.module h2 {
  font-size: 1.2rem;
  font-weight: bold;
  margin: 0 0 4px;
}

.module .meta {
  font-size: 0.9rem;
  color: #444;
  margin-bottom: 12px;
}

.module .desc {
  font-size: 0.95rem;
  line-height: 1.4;
}
</style>
