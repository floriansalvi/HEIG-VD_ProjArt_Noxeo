<template>
  <div class="onboarding-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <main class="onboarding-main">
      <p class="breadcrumb">Learning &gt; Onboarding</p>
      <h1 class="section-title">Onboarding</h1>

      <div class="tiles">
        <div
          v-for="course in courses"
          :key="course.id"
          class="tile"
          :style="{ backgroundImage: `url(${course.image})` }"
        >
          <div class="overlay">
            <h2>{{ course.title }}</h2>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import AppHeader from '@/layouts/AppHeader.vue'
import { ref, onMounted } from 'vue'
import AppMenu from '@/layouts/AppMenu.vue'

const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}

const courses = ref([])

onMounted(() => {
  courses.value = [
    { id: 1, title: 'History', image: '/assets/courses/history.jpg' },
    {
      id: 2,
      title: 'Inspiration and positionning',
      image: '/assets/courses/inspiration.jpg',
    },
    {
      id: 3,
      title: 'Understanding the collection',
      image: '/assets/courses/understanding.jpg',
    },
    { id: 4, title: 'Core collections', image: '/assets/courses/core.jpg' },
    { id: 5, title: 'Storytelling', image: '/assets/courses/storytelling.jpg' },
  ]
})
</script>

<style scoped>
.onboarding-page {
  background-color: #fff;
  min-height: 100vh;
  padding-top: 80px; /* leave space for header */
}

.onboarding-main {
  padding: 24px 16px;
}

.breadcrumb {
  font-size: 0.85rem;
  color: #555;
  margin-bottom: 8px;
}

.section-title {
  font-size: 1.4rem;
  font-weight: bold;
  margin-bottom: 24px;
}

.tiles {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.tile {
  position: relative;
  height: 160px;
  background-size: cover;
  background-position: center;
  border-radius: 8px;
  overflow: hidden;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 12px 16px;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
  width: 100%;
  color: white;
}

.overlay h2 {
  font-size: 1.1rem;
  margin: 0;
}
</style>
