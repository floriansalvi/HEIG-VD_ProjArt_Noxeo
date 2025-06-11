<template>
  <router-view />
</template>

<script setup lang="ts">
import { RouterView } from 'vue-router'
</script>

<style>
/* Global styles optionnels ici */
body {
  margin: 0;
  font-family: var(--font-family-main);
  background-color: var(--color-white);
}
</style>
