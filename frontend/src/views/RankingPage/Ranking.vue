<script setup>
import { ref, watch, onMounted, inject } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import infoIcon from '@/assets/icons/info.png'
import { useRouter } from 'vue-router'
import auth from '@/services/auth'

const $http = inject('$http');

const router = useRouter()

const currentTab = ref('world')
const ranking = ref([])
const currentUser = ref(auth.user)
const menuVisible = ref(false)
const showInfo = ref(false)

const toggleMenu = () => (menuVisible.value = !menuVisible.value)

async function fetchRanking(type) {
  try {
    await $http.get('/sanctum/csrf-cookie')
    const url = type === 'world' ? '/api/v1/leaderboard' : '/api/v1/leaderboard/market'
    const response = await $http.get(url)

    const data = response.data.data.ranking || response.data.data

    const transformed = data.map((user, index) =>({
      id: user.user_id,
      name: user.nickname,
      points: Number(user.total_score) + 2000000,
      rank: index + 1
    }))

    ranking.value = transformed

    console.log('auth.user.value:', auth.user.value)

    const userInRanking = transformed.find(u => u.id === auth.user.value.id)
    if(userInRanking) {
      currentUser.value = userInRanking
    } else {
      currentUser.value = null // ou garde auth.user si tu veux
    }

  } catch (err) {
    console.log(err)
  }
}

watch(currentTab, () => fetchRanking(currentTab.value))
onMounted(() => {
  fetchRanking(currentTab.value)
})
</script>

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

      <div class="ranking-scroll">
        <div v-if="currentUser" class="user-highlight">
          <span>{{ currentUser.rank }}.</span>
          <span>{{ currentUser.name }}</span>
          <span>{{ currentUser.points }} PTS</span>
        </div>

        <ul class="ranking-list">
          <li
            v-for="user in ranking"
            :key="user.id"
            :class="{ me: user.id === currentUser?.id }"
          >
            <span>{{ user.rank }}.</span>
            <span>{{ user.name }}</span>
            <span>{{ user.points }} PTS</span>
          </li>
        </ul>
      </div>
    </main>
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

    <div v-if="showInfo" class="modal-overlay" @click.self="showInfo = false">
      <div class="modal">
        <button class="close-btn" @click="showInfo = false">&times;</button>
        <h2>Why does the ranking matter?</h2>
        <p>
          The top 16 participants from each market will qualify to take part in
          the Breitling Cup as a team. The ranking is based on the points earned
          through lessons and tests, with scores depending on correct answers,
          and for tests, speed also plays a key role.
        </p>
        <p>
          During the tournament, the selected teams will face challenges testing
          their knowledge of the brand, its products and services. Team spirit
          and passion will be key!
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.ranking-page {
  padding-top: 80px;
  background: white;
  min-height: 100vh;
  font-family: var(--font-family-main);
  display: flex;
  flex-direction: column;
}

.ranking-main {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.ranking-header {
  position: sticky;
  top: 80px;
  background: white;
  z-index: 10;
  padding: 16px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid #eee;
}

.info-icon {
  width: 22px;
  height: 22px;
  cursor: pointer;
  padding: 0.7rem;
}

.ranking-scroll {
  flex: 1;
  overflow-y: auto;
  padding: 0 16px;
}

.user-highlight {
  position: fixed;
  top: 14rem; /* ajuste selon ton layout exact */
  left: 50%;
  transform: translateX(-50%);
  z-index: 20;
  background: #fff;
  border: 1px solid black;
  padding: 10px 14px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 90%;
  max-width: 320px;
}

.ranking-list {
  list-style: none;
  padding: 0;
  margin: 6rem 0 0 0; /* ✅ Ajout d'une marge en haut pour ne pas chevaucher user-highlight */
}

.ranking-list li {
  display: flex;
  justify-content: space-between;
  padding: 14px 0;
  border-bottom: 1px solid #e2e2e2;
  font-size: 1rem;
}

.ranking-list li.me {
  background-color: #fff4b0;
  font-weight: bold;
}

.tab-toggle {
  position: fixed;
  bottom: 3rem;
  left: 50%;
  transform: translateX(-50%);
  z-index: 15;
  display: flex;
  justify-content: space-evenly;
  border: 1.5px solid black;
  background-color: white;
  width: 90%;
  max-width: 320px;
}

.tab-toggle {
  border: 1.5px solid black;

  overflow: hidden;
  width: 90%;
  max-width: 300px;
}

.tab-toggle button {
  flex: 1;
  padding: 12px 0;
  background-color: white;
  color: black;
  border: none;
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.2s;
}

.tab-toggle button.active {
  background-color: black;
  color: white;
}

/* Modal */
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 50;
}

.modal {
  background: white;
  max-width: 360px;
  padding: 24px;
  border-radius: 10px;
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
