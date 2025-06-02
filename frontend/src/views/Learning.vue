<template>
  <div class="learning-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <main class="learning-main">
      <h1 class="page-title">Learning</h1>

      <div
        v-for="section in sections"
        :key="section.title"
        class="section-block"
      >
        <div class="section-header">
          <h2>{{ section.title }}</h2>
          <router-link :to="section.link" class="see-all"
            >see all →</router-link
          >
        </div>

        <div class="courses-scroll">
          <div
            v-for="course in section.courses"
            :key="course.id"
            class="course-card"
            :style="{ backgroundImage: `url(${course.image})` }"
          >
            <div class="overlay">
              <h3>{{ course.title }}</h3>
            </div>
          </div>
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

const sections = [
  {
    title: 'Onboarding',
    link: '/learning/onboarding',
    courses: [
      { id: 1, title: 'History', image: '/assets/courses/history.jpg' },
      { id: 2, title: 'Inspiration', image: '/assets/courses/inspiration.jpg' },
      {
        id: 7,
        title: 'Getting Started',
        image: '/assets/courses/getting-started.jpg',
      },
      { id: 8, title: 'First Steps', image: '/assets/courses/first-steps.jpg' },
    ],
  },
  {
    title: 'Discovery',
    link: '/learning/discovery',
    courses: [
      {
        id: 3,
        title: 'Presenting the collection',
        image: '/assets/courses/collection.jpg',
      },
      { id: 4, title: 'Marketing', image: '/assets/courses/marketing.jpg' },
    ],
  },
  {
    title: 'Novelties',
    link: '/learning/novelties',
    courses: [
      { id: 5, title: 'Novelties #1', image: '/assets/courses/novelties1.jpg' },
      { id: 6, title: 'Novelties #2', image: '/assets/courses/novelties2.jpg' },
    ],
  },
]
</script>

<style scoped>
.learning-page {
  background-color: #fff;
  min-height: 100vh;
  padding-top: 80px;
  position: relative;
}

.learning-main {
  padding: 24px 16px;
}

.page-title {
  font-size: 1.6rem;
  font-weight: bold;
  margin-bottom: 24px;
}

.section-block {
  margin-bottom: 32px;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.section-header h2 {
  font-size: 1.1rem;
  font-weight: bold;
}

.see-all {
  font-size: 0.9rem;
  text-decoration: none;
  color: #000;
}

.courses-scroll {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  padding-bottom: 4px;
}

.course-card {
  min-width: 160px;
  height: 100px;
  border-radius: 8px;
  background-size: cover;
  background-position: center;
  position: relative;
  flex-shrink: 0;
}

.overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  padding: 8px;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
  width: 100%;
  color: white;
  font-size: 0.95rem;
}
</style>
