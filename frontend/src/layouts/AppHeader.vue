<template>
  <header class="app-header">
    <div class="header-content">
      <!-- Rend tout le bloc cliquable -->
      <router-link to="/learning-path" class="brand-link">
        <div class="brand">
          <img src="@/assets/logo-b.png" alt="B logo" class="logo-b" />
          <span class="text">LEAGUE</span>
          <span class="separator">|</span>
          <img src="@/assets/ecusson-bleague.png" alt="Badge" class="badge" />
        </div>
      </router-link>

      <button class="menu-btn" @click="$emit('menu')">☰</button>
    </div>
  </header>
</template>

<script setup>
// rien à modifier ici
</script>

<style scoped>
.app-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 20;
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
  justify-content: center;
  align-items: center;
  position: relative;
}

/* Le lien autour du logo */
.brand-link {
  text-decoration: none;
  color: inherit;
}

/* Bloc cliquable */
.brand {
  display: flex;
  align-items: center;
  gap: 10px;
  font-weight: bold;
  font-size: 1.1rem;
  text-align: center;
  cursor: pointer;
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
  right: 0.4rem;
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
}
</style>
