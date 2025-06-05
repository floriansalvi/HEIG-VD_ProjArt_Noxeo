<template>
  <div class="course-scroller">
    <h2 class="module-title">{{ module.title }}</h2>
    <div class="scroll-zone" ref="scrollZone">
      <div
        v-for="(lesson, index) in module.lessons"
        :key="index"
        class="lesson-card"
        @click="startLesson(lesson)"
      >
        <h3>{{ lesson.title }}</h3>
        <p>{{ lesson.points }}PTS</p>
      </div>
    </div>

    <!-- Scroll arrows -->
    <div class="scroll-arrows">
      <button @click="scroll('left')">←</button>
      <button @click="scroll('right')">→</button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const props = defineProps({
  module: {
    type: Object,
    required: true,
  },
})

const scrollZone = ref(null)

function scroll(direction) {
  const zone = scrollZone.value
  if (!zone) return
  const amount = 200
  zone.scrollBy({
    left: direction === 'left' ? -amount : amount,
    behavior: 'smooth',
  })
}

function startLesson(lesson) {
  console.log('Start lesson:', lesson)
}
</script>

<style scoped>
.course-scroller {
  padding: 24px 16px;
  color: #111;
}

.module-title {
  font-size: 1.2rem;
  font-weight: bold;
  margin-bottom: 16px;
  color: #0033cc;
}

.scroll-zone {
  display: flex;
  overflow-x: auto;
  scroll-snap-type: x mandatory;
  gap: 12px;
  padding-bottom: 12px;
}

.lesson-card {
  min-width: 200px;
  background: #fff9e0;
  border-radius: 12px;
  padding: 16px;
  scroll-snap-align: start;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  flex-shrink: 0;
}

.scroll-arrows {
  display: flex;
  justify-content: space-between;
  margin-top: 12px;
}

.scroll-arrows button {
  background: #0033cc;
  color: white;
  border: none;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 1.1rem;
  cursor: pointer;
}
</style>
