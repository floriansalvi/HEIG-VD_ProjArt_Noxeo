<template>
  <div class="learning-scroll-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <!-- cadran fixe -->
    <div class="cadran-fixed">
      <img src="@/assets/cadran.jpg" alt="cadran" />
    </div>

    <!-- scrollable modules -->
    <div class="modules-scroll">
      <section v-for="(step, index) in steps" :key="index" class="module-step">
        <h2>{{ step.title }}</h2>
        <p class="meta">{{ step.category }} · {{ step.points }}PTS</p>
        <p class="desc">{{ step.description }}</p>
        <button class="start-btn">{{ step.buttonLabel }}</button>
      </section>
    </div>
    <div class="modules-scroll">
      <section v-for="(step, index) in steps" :key="index" class="module-step">
        <h2>{{ step.title }}</h2>
        <p class="meta">{{ step.category }} · {{ step.points }}PTS</p>
        <p class="desc">{{ step.description }}</p>
        <button class="start-btn">{{ step.buttonLabel }}</button>
      </section>
    </div>
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

const steps = [
  {
    title: 'History',
    category: 'Onboarding',
    points: 1000,
    description:
      "You'll discover the rich history of Breitling from 1884 to its key moments.",
    buttonLabel: 'Start lesson',
  },
  {
    title: 'Test History',
    category: 'Onboarding',
    points: 10000,
    description:
      'This test will check your understanding of Breitling’s heritage and key facts.',
    buttonLabel: 'Start test',
  },
  // Ajoute d’autres modules ici
]
</script>

<style scoped>
.learning-scroll-page {
  position: relative;
  background: white;
  height: 100vh;
  overflow-x: hidden;
  font-family: var(--font-family-main);
}

.cadran-fixed {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 100vw;
  max-width: 500px;
  transform: translate(-50%, -50%);
  z-index: 5;
  pointer-events: none;
}

.cadran-fixed img {
  width: 100%;
  height: auto;
  display: block;
}

.modules-scroll {
  position: relative;
  z-index: 1;
  padding-top: 100vh; /* pour que le premier scroll n'écrase pas la montre */
}

.module-step {
  height: 100vh;
  padding: 40vh 16px 0;
  text-align: center;
}

.module-step h2 {
  font-size: 1.5rem;
  font-weight: bold;
}

.meta {
  margin: 8px 0 16px;
  font-size: 0.95rem;
}

.desc {
  font-size: 1rem;
  max-width: 80%;
  margin: 0 auto 24px;
}

.start-btn {
  background-color: #ffc72c;
  padding: 12px 24px;
  border-radius: 8px;
  font-weight: bold;
  border: none;
  cursor: pointer;
}
.modules-scroll {
  position: relative;
  z-index: 1;
  scroll-snap-type: y mandatory;
  overflow-y: scroll;
  height: 100vh;
}

.module-step {
  height: 100vh;
  padding-top: 45vh;
  text-align: center;
  scroll-snap-align: start;
}
</style>
