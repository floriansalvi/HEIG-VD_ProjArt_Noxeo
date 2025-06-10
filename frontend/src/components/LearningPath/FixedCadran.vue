<template>
  <img src="@/assets/cadran.svg" class="cadran" alt="Cadran" />
</template>

<style scoped>
.cadran {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 320px;
  z-index: 0;
  opacity: 100%; /*optionnel : pour un effet "fond" discret */
  pointer-events: none;
}
</style>
