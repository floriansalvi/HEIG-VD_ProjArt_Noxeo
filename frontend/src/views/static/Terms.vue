<template>
  <div class="static-page">
    <AppHeader />
    <main class="static-main">
      <h1>Terms & Conditions</h1>
      <p>Here will be your legal terms content...</p>
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
