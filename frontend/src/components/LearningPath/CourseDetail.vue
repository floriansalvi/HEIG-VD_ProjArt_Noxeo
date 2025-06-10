<template>
  <div class="course-detail">
    <h2>{{ module.title }}</h2>
    <p>{{ module.description }}</p>
    <button class="start-btn">Start {{ module.type }}</button>
  </div>
</template>

<script setup>
defineProps({
  module: Object,
})
</script>

<style scoped>
.course-detail {
  width: 40%;
  padding: 40px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.course-detail h2 {
  font-size: 1.5rem;
  margin-bottom: 12px;
}
.course-detail p {
  font-size: 1rem;
  margin-bottom: 16px;
}
.start-btn {
  background: #f4c542;
  border: none;
  padding: 12px 20px;
  font-weight: bold;
  border-radius: 6px;
  cursor: pointer;
}
</style>
