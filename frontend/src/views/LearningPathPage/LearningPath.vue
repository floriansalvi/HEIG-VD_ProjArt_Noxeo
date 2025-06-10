<template>
  <div class="learning-path">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <div class="scroller" @wheel.prevent="handleScroll">
      <div class="module-block" v-if="currentModule">
        <div class="content">
          <h2>{{ currentModule.title }}</h2>
          <p class="meta">
            Onboarding • {{ currentModule.points.toLocaleString() }} PTS
          </p>
          <p class="desc">{{ currentModule.description }}</p>
          <button class="start-btn">Start {{ currentModule.type }}</button>
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
      'Test your understanding of Breitling’s heritage and timepieces.',
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
}

.scroller {
  height: calc(100vh - 80px);
  padding-top: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.module-block {
  height: 100%;
  width: 100%;
  display: flex;
  justify-content: left;
  align-items: center;
}

.content {
  text-align: center;
  max-width: 300px;
  padding: 20px;
}

.content h2 {
  font-size: 1.6rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
}

.meta {
  font-size: 0.9rem;
  color: #777;
  margin-bottom: 1rem;
}

.desc {
  font-size: 1rem;
  margin-bottom: 1.5rem;
  line-height: 1.4;
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
