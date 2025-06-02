<template>
  <div class="learning-subpage">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />
    <main class="subpage-main">
      <h1>Novelties</h1>
      <div class="course-list">
        <div v-for="course in courses" :key="course.id" class="course-card">
          <img :src="course.image" :alt="course.title" />
          <div class="info">
            <h3>{{ course.title }}</h3>
            <p>{{ course.description }}</p>
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
    {
      id: 5,
      title: 'Novelties #1',
      image: '/assets/courses/novelties1.jpg',
      description: 'Discover the first wave of new arrivals.',
    },
    {
      id: 6,
      title: 'Novelties #2',
      image: '/assets/courses/novelties2.jpg',
      description: 'Continue your training with the latest models.',
    },
  ]
})
</script>

<style scoped>
.learning-subpage {
  padding-top: 80px;
  background: white;
  min-height: 100vh;
}

.subpage-main {
  padding: 24px 16px;
}

.course-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.course-card {
  display: flex;
  background: #f2f2f2;
  border-radius: 8px;
  overflow: hidden;
}

.course-card img {
  width: 100px;
  height: 100px;
  object-fit: cover;
}

.info {
  padding: 12px;
  flex: 1;
}

.info h3 {
  margin: 0 0 4px;
  font-size: 1.1rem;
}
</style>
