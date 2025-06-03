<template>
  <div class="static-page">
    <AppHeader />
    <main class="static-main">
      <h1>Privacy Policy</h1>
      <p>This is where your privacy information will go...</p>
    </main>
  </div>
</template>

<script setup>
import AppHeader from '@/layouts/AppHeader.vue'
</script>

<style scoped>
.static-page {
  padding-top: 80px;
  background: white;
  min-height: 100vh;
}
.static-main {
  padding: 24px 16px;
}
</style>
