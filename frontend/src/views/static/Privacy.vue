<template>
  <div class="static-page">
    <AppHeader />
    <main class="static-main">
      <div class="static-container">
        <h1 class="page-title">Privacy Policy</h1>
        <p class="updated-date">Last updated: June 2022</p>

        <section v-for="(section, index) in sections" :key="index">
          <h2>{{ section.title }}</h2>
          <p v-for="(para, pIdx) in section.paragraphs" :key="pIdx">
            {{ para }}
          </p>
        </section>
      </div>
    </main>
  </div>
</template>
<script setup>
import AppHeader from '@/layouts/AppHeader.vue'
import { privacySections } from '@/data/privacyData.js'

const sections = privacySections
</script>
<style scoped>
.static-page {
  background-color: #fff;
  min-height: 100vh;
  padding-top: 80px;
  font-family: var(--font-family-main);
}

.static-main {
  padding: 24px 16px;
}

.static-container {
  max-width: 800px;
  margin: 0 auto;
}

.page-title {
  font-size: 1.6rem;
  font-weight: bold;
  margin-bottom: 4px;
}

.updated-date {
  font-size: 0.85rem;
  color: #888;
  margin-bottom: 24px;
}

h2 {
  font-size: 1.2rem;
  margin-top: 24px;
  margin-bottom: 8px;
  color: var(--color-blue, #0033cc);
}

p {
  font-size: 0.95rem;
  line-height: 1.6;
  margin-bottom: 12px;
}
</style>
