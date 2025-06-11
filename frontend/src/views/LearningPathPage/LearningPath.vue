<template>
  <div class="learning-path">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <div class="scroller" @wheel.prevent="handleScroll">
      <div class="learning-header">
        <h1>Learning path</h1>
        <p>scroll your path !</p>
      </div>

      <div class="module-block">
        <div class="arc-wrapper">
          <!-- Arc radial -->
          <svg viewBox="0 0 200 200" class="arc-svg">
            <g>
              <line
                v-for="i in tickCount"
                :key="i"
                x1="100"
                y1="10"
                x2="100"
                y2="20"
                :stroke="tickColor(i - 1)"
                stroke-width="2"
                stroke-linecap="round"
                :transform="`rotate(${tickAngle(i + 95)} 100 100)`"
              />
            </g>
          </svg>

          <!-- Texte centré dans l’arc -->
          <div class="text-center-inside">
            <h2>{{ currentModule.title }}</h2>
            <p class="meta">
              Onboarding {{ currentModule.points.toLocaleString() }}PTS
            </p>
            <p class="desc">{{ currentModule.description }}</p>
          </div>
        </div>

        <!-- Bouton en bas à droite -->
        <div class="start-btn-container">
          <button class="start-btn">start {{ currentModule.type }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'

const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)

const modules = ref([
  {
    title: 'History',
    type: 'lesson',
    points: 10000,
    description: 'Discover the rich history of Breitling from 1884 to now.',
  },
  {
    title: 'Test history',
    type: 'test',
    points: 10000,
    description:
      'Test your understanding of Breitling’s heritage from 1884 to its major innovations.',
  },
  {
    title: 'Innovation',
    type: 'lesson',
    points: 8000,
    description: 'Explore Breitling’s key innovations in watchmaking.',
  },
])

const activeIndex = ref(0)
const currentModule = computed(() => modules.value[activeIndex.value])

const tickCount = 40

const tickAngle = (i) => {
  const start = -110
  const end = 110
  return start + ((end - start) * i) / (tickCount - 1)
}

const tickColor = (i) => {
  const ratio = (activeIndex.value + 1) / modules.value.length
  const indexLimit = Math.floor(tickCount * ratio)

  if (i < indexLimit - 1) return '#f4c542'
  if (i === indexLimit - 1) return '#000'
  return '#ddd'
}

let scrollCooldown = false
function handleScroll(e) {
  if (scrollCooldown) return
  scrollCooldown = true

  const direction = e.deltaY > 0 ? 1 : -1
  const nextIndex = activeIndex.value + direction

  if (nextIndex >= 0 && nextIndex < modules.value.length) {
    activeIndex.value = nextIndex
  }

  setTimeout(() => {
    scrollCooldown = false
  }, 500)
}
</script>

<style scoped>
.learning-path {
  background: #fff;
  min-height: 100vh;
  overflow: hidden;
  position: relative;
  z-index: 0;
}

.learning-path::before {
  content: '';
  position: absolute;
  top: 4rem;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('@/assets/breitling_store.png');
  background-size: cover;
  background-position: center;
  opacity: 0.4;
  z-index: 0;
  pointer-events: none;
}

.learning-path::after {
  content: '';
  position: absolute;
  top: 4rem;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
  opacity: 0.4;
  z-index: 1;
  pointer-events: none;
}

.scroller {
  height: calc(100vh - 80px);
  padding-top: 80px;
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  z-index: 2;
}

.learning-header {
  text-align: left;
  width: 100%;
  max-width: 300px;
  padding: 30px;
}

.learning-header h1 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #000;
  margin-left: -1rem;
}

.learning-header p {
  font-size: 0.9rem;
  color: #555;
  margin-top: -1rem;
  margin-left: -1rem;
}

.module-block {
  position: relative;
  width: 100%;
  max-width: 420px;
  min-height: 440px;
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.arc-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
  z-index: 3;
}

.arc-wrapper::before {
  content: '';
  clip-path: circle(50% at 50% 50%);
  position: absolute;
  top: -46px;
  left: -135px;
  width: 460px;
  height: 420px;
  background-image: url('@/assets/cadran.png'); /* ← image cadran détourée */
  background-size: cover;
  background-position: center;
  z-index: 0;
  pointer-events: none;
}

.arc-svg {
  position: absolute;
  left: -90px;
  top: 0px;
  width: 350px;
  height: 320px;
  transform: rotate(-90deg);
  z-index: 1;
}

.text-center-inside {
  position: absolute;
  top: 10rem;
  left: 6rem;
  transform: translate(-45%, -50%);
  width: 180px;
  text-align: left;
  z-index: 2;
}

.text-center-inside h2 {
  font-size: 1.4rem;
  font-weight: bold;
  margin-bottom: 0.4rem;
  color: #000;
}

.text-center-inside .meta {
  font-size: 0.9rem;
  color: #444;
  margin-bottom: 1rem;
}

.text-center-inside .desc {
  font-size: 1rem;
  line-height: 1.4;
  margin-bottom: 1.5rem;
  color: #333;
}

.start-btn-container {
  width: 80%;
  display: flex;
  justify-content: flex-end;
  padding: 0 1rem 1rem;
  margin-top: auto;
}

.start-btn {
  background: #f4c542;
  border: none;
  padding: 12px 24px;
  font-weight: bold;
  border-radius: 6px;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
