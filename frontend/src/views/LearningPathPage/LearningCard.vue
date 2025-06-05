<template>
  <div class="learning-card">
    <!-- Cadran (image de fond décorative) -->
    <img src="@/assets/cadran.jpg" alt="cadran" class="cadran-bg" />

    <!-- Contenu au centre du cadran -->
    <div class="card-content">
      <h2 :class="{ bold: type === 'test' }">
        {{ type === 'test' ? 'Test ' + title : title }}
      </h2>
      <p class="meta">{{ category }} {{ points.toLocaleString() }}PTS</p>
      <p class="desc">{{ description }}</p>
      <button class="cta">{{ buttonText }}</button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  type: String, // 'lesson' ou 'test'
  title: String,
  category: String,
  points: Number,
  description: String,
  buttonText: String,
})
</script>

<style scoped>
.learning-card {
  position: relative;
  width: 100%;
  max-width: 400px;
  margin: 2rem auto;
  padding: 3rem 1rem 1rem;
  background: #fff;
  text-align: center;
  overflow: hidden;
}

/* Image du cadran */
.cadran-bg {
  position: absolute;
  top: 0;
  left: 50%;
  width: 120%;
  max-width: 500px;
  transform: translateX(-50%);
  z-index: 1;
  opacity: 0.9;
}

/* Contenu centré par-dessus */
.card-content {
  position: relative;
  z-index: 2;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2rem 1rem;
}

h2 {
  font-size: 1.6rem;
  margin-bottom: 0.25rem;
}

h2.bold {
  font-weight: 700;
}

.meta {
  font-size: 0.9rem;
  color: #222;
  margin-bottom: 0.75rem;
}

.desc {
  font-size: 0.95rem;
  color: #333;
  margin-bottom: 1.5rem;
  max-width: 260px;
}

.cta {
  background: #f6c53f;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  font-weight: bold;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
  cursor: pointer;
  transition: background 0.2s;
}

.cta:hover {
  background: #eab52b;
}
</style>
