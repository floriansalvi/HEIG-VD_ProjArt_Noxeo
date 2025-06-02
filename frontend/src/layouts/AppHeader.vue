<template>
  <header class="app-header">
    <div class="header-content">
      <div class="brand">
        <img src="@/assets/logo-b.png" alt="B logo" class="logo-b" />
        <span class="text">LEAGUE</span>
        <span class="separator">|</span>
        <img src="@/assets/ecusson-bleague.png" alt="Badge" class="badge" />
      </div>
      <button class="menu-btn" @click="$emit('menu')">☰</button>
    </div>
  </header>
</template>

<script setup>
// Évènement menu si besoin
</script>

<style scoped>
.app-header {
  position: fixed; /* 👈 fixe le header en haut */
  top: 0;
  left: 0;
  right: 0;
  z-index: 20; /* 👈 toujours au-dessus du menu */
  background-color: #ffc72c;
  padding: 16px;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80px;
}

.header-content {
  width: 100%;
  max-width: 900px;
  display: flex;
  justify-content: center; /* 👈 centre horizontalement tout */
  align-items: center;
  position: relative;
}

/* Bloc centré */
.brand {
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: bold;
  font-size: 1.1rem;
  text-align: center;
}

.logo-b {
  height: 24px;
}

.text {
  letter-spacing: 0.05rem;
}

.separator {
  font-weight: normal;
  font-size: 1.2rem;
  opacity: 0.6;
}

.badge {
  height: 32px;
}

.menu-btn {
  position: absolute;
  right: 0;
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}
</style>
