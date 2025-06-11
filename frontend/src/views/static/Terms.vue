<template>
  <div class="legal-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <div class="content">
      <h1 class="title-xl">Terms & Conditions</h1>
      <p class="small-text">Last updated: June 2022</p>

      <section v-for="(section, index) in sections" :key="index">
        <h2 class="title-lg">{{ section.title }}</h2>
        <p
          v-for="(para, pIdx) in section.paragraphs"
          :key="pIdx"
          class="text-body"
        >
          {{ para }}
        </p>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { termsSections } from '@/data/termsData.js'

const sections = termsSections
const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)
</script>

<style scoped>
.legal-page {
  background: #fff;
  min-height: 100vh;
  padding-top: 80px;
}

.content {
  padding: 24px;
  max-width: 600px;
  margin: 0 auto;
}
</style>
