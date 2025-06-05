<template>
  <div class="learning-path">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <!-- cadran en fond partiellement visible -->
    <div class="cadran-mask">
      <img src="@/assets/cadran.jpg" class="cadran-img" alt="Cadran" />
    </div>

    <main class="modules">
      <h1 class="title">Learning path</h1>
      <p class="subtitle">scroll your path !</p>

      <section class="module-step">
        <h2 class="module-title">History</h2>
        <p class="module-meta">Onboarding · 1000PTS</p>
        <p class="module-desc">
          In this module, you’ll discover the rich history of Breitling from its
          founding in 1884 to its key innovations and iconic moments.
        </p>
        <button class="module-button" @click="console.log('Start lesson')">
          start lesson
        </button>
      </section>

      <section class="module-step">
        <h2 class="module-title">Test history</h2>
        <p class="module-meta">Onboarding · 10’000PTS</p>
        <p class="module-desc">
          This test will check your understanding of Breitling’s heritage from
          its 1884 origins to its major innovations and timepieces.
        </p>
        <button class="module-button" @click="console.log('Start test')">
          start test
        </button>
      </section>
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
.learning-path {
  background-color: white;
  min-height: 100vh;
  overflow-x: hidden;
  position: relative;
}

.cadran-mask {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 280px;
  overflow: hidden;
  z-index: 0;
  pointer-events: none;
}

.cadran-img {
  width: 100%;
  object-fit: cover;
  object-position: top center;
  opacity: 1;
}

.modules {
  position: relative;
  z-index: 1;
  padding: 32px 16px;
  margin-top: 220px;
  display: flex;
  flex-direction: column;
  gap: 64px;
}

.title {
  font-size: 1.8rem;
  font-weight: bold;
  margin-bottom: 4px;
  color: #111;
}

.subtitle {
  color: #444;
  margin-bottom: 32px;
}

.module-step {
  background: white;
  padding: 24px 20px;
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.module-title {
  font-size: 1.3rem;
  font-weight: bold;
  margin-bottom: 8px;
}

.module-meta {
  font-size: 0.95rem;
  color: #555;
  margin-bottom: 16px;
}

.module-desc {
  font-size: 1rem;
  line-height: 1.5;
  color: #222;
  margin-bottom: 24px;
}

.module-button {
  background-color: #f5c338;
  border: none;
  padding: 12px 20px;
  font-weight: bold;
  font-size: 1rem;
  border-radius: 8px;
  cursor: pointer;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  width: 100%;
}
</style>
