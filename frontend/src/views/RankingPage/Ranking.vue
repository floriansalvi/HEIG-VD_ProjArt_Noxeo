<template>
  <div class="ranking-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <main class="ranking-main">
      <div class="ranking-header">
        <h1>
          {{ currentTab === 'world' ? 'World ranking' : 'Market ranking' }}
        </h1>
        <img
          :src="infoIcon"
          alt="info"
          class="info-icon"
          @click="showInfo = true"
        />
      </div>

      <!-- Highlighted user line if ranked -->
      <div v-if="highlightedUser" class="user-highlight">
        <span>{{ highlightedUser.rank }}.</span>
        <span>{{ highlightedUser.name }}</span>
        <span>{{ highlightedUser.points }}PTS</span>
      </div>

      <ul class="ranking-list">
        <li
          v-for="user in ranking"
          :key="user.id"
          :class="{ me: user.id === currentUserId }"
        >
          <span>{{ user.rank }}.</span>
          <span>{{ user.name }}</span>
          <span>{{ user.points }}PTS</span>
        </li>
      </ul>
    </main>

    <!-- Bottom tab toggle -->
    <div class="tab-toggle">
      <button
        :class="{ active: currentTab === 'world' }"
        @click="currentTab = 'world'"
      >
        World
      </button>
      <button
        :class="{ active: currentTab === 'market' }"
        @click="currentTab = 'market'"
      >
        Market
      </button>
    </div>

    <!-- Info Modal -->
    <div v-if="showInfo" class="modal-overlay" @click.self="showInfo = false">
      <div class="modal">
        <button class="close-btn" @click="showInfo = false">&times;</button>
        <h2>Why does the ranking matter ?</h2>
        <p>
          The top 16 participants from each market will qualify to take part in
          the Breitling Cup as a team. The ranking is based on the points earned
          through lessons and tests, with scores depending on correct answers,
          and for tests, speed also plays a key role.
        </p>
        <p>
          During the tournament, the selected teams will face a series of
          challenges designed to test their knowledge of the brand, its
          products, and its services. Team spirit, expertise, and a passion for
          Breitling will be key to making it to the top!
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import infoIcon from '@/assets/icons/info.png'

const currentTab = ref('world')
const ranking = ref([])
const menuVisible = ref(false)
const showInfo = ref(false)
const currentUserId = 10 // À remplacer plus tard par store/auth

const toggleMenu = () => (menuVisible.value = !menuVisible.value)

const highlightedUser = ref(null)

async function fetchRanking(type) {
  // Simulation (à remplacer par appel backend réel)
  const data =
    type === 'world'
      ? [
          { id: 1, name: 'Xu Lee', points: 12300 },
          { id: 2, name: 'Marco', points: 12100 },
          { id: 10, name: 'Michael', points: 7300, rank: 82 },
          // ...
        ]
      : [
          { id: 1, name: 'Nadia', points: 9700 },
          { id: 2, name: 'Noémie', points: 9500 },
          { id: 10, name: 'Michael', points: 7300, rank: 10 },
          // ...
        ]

  ranking.value = data.slice(0, 16).map((u, i) => ({ ...u, rank: i + 1 }))
  highlightedUser.value = data.find(
    (u) => u.id === currentUserId && u.rank > 16
  )
}

watch(currentTab, (newTab) => {
  fetchRanking(newTab)
})

onMounted(() => {
  fetchRanking(currentTab.value)
})
</script>

<style scoped>
.ranking-page {
  padding-top: 80px;
  min-height: 100vh;
  background: white;
  position: relative;
  font-family: var(--font-family-main);
}

.ranking-main {
  padding: 24px 16px;
}

.ranking-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.user-highlight {
  background-color: #fff4b0;
  border-radius: 12px;
  padding: 12px 16px;
  margin-bottom: 16px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.info-icon {
  width: 23px;
  height: 23px;
  cursor: pointer;
  padding: 0.7rem;
}

.ranking-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.ranking-list li {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 14px 16px;
  border-bottom: 1px solid #e2e2e2;
  font-size: 1rem;
}

.ranking-list li.me {
  background-color: #fff4b0;
  font-weight: bold;
}

.tab-toggle {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  display: flex;
  justify-content: space-evenly;
  background: white;
  border-top: 1px solid #e2e2e2;
  padding: 10px 0;
}

.tab-toggle button {
  flex: 1;
  border: none;
  background: transparent;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  position: relative;
  padding-bottom: 4px;
}

.tab-toggle button.active {
  border-bottom: 2px solid black;
}

.info-btn {
  background: none;
  border: none;
  font-size: 1.2rem;
  cursor: pointer;
}

/* Modale info */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 100;
}

.modal {
  background: white;
  max-width: 360px;
  padding: 24px;
  border-radius: 8px;
  box-shadow: 0 0 16px rgba(0, 0, 0, 0.2);
  position: relative;
}

.close-btn {
  position: absolute;
  top: 12px;
  right: 16px;
  border: none;
  background: none;
  font-size: 1.4rem;
  cursor: pointer;
}
</style>
