<template>
  <div class="profile-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <main class="profile-main">
      <section class="user-info">
        <div class="top-row">
          <h1>Profile</h1>
          <RouterLink to="/settings" class="edit-link">
            edit <span class="edit-icon">&#9998;</span>
          </RouterLink>
        </div>

        <div class="user-box">
          <img class="avatar" :src="user.avatar" alt="avatar" />
          <div class="details">
            <h2>{{ user.name }}</h2>
            <p>{{ user.points.toLocaleString() }} PTS</p>
            <strong>{{ mainTitle }}</strong>
          </div>
        </div>

        <div class="progress-bar">
          <template v-for="(step, i) in steps" :key="step">
            <div class="step">
              <div :class="['dot', { done: isStepDone(i) }]">
                <span v-if="isStepDone(i)">✔</span>
              </div>
              <span class="label">{{ step }}</span>
            </div>
            <div v-if="i < steps.length - 1" class="line"></div>
          </template>
        </div>
      </section>

      <section class="badges-section">
        <h2>Titles</h2>
        <div class="badges">
          <Badge v-for="badge in titles" :key="badge.name" :badge="badge" />
        </div>

        <h2>Novelties badges</h2>
        <div class="badges scrollable">
          <Badge v-for="badge in novelties" :key="badge.name" :badge="badge" />
        </div>

        <h2>Special badges</h2>
        <div class="badges scrollable">
          <Badge v-for="badge in specials" :key="badge.name" :badge="badge" />
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import Badge from '@/components/Profile/Badge.vue'
import { RouterLink } from 'vue-router'

const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)

const user = ref({
  name: 'Michael',
  points: 3800,
  avatar: '/assets/image.png',
  titles: [
    { name: 'Aviator', icon: 'aviator.png', earned: true },
    { name: 'Chrono-Master', icon: 'chronomaster.png', earned: true },
  ],
  novelties: [
    { name: 'Professional', earned: true },
    { name: 'Chronomat', earned: true },
    { name: 'Classic AVI', earned: true },
    { name: 'Top Time', earned: true },
    { name: 'Superocean', earned: true },
  ],
  specials: [
    { name: "Mother's Day", earned: true },
    { name: 'History', earned: true },
    { name: 'Collections', earned: true },
    { name: 'Technique', earned: true },
  ],
})

const steps = ['Onboarding', 'Discovery', 'Novelties']
const isStepDone = (i) => false // aucun de base validé

const hasSpecialist = computed(
  () =>
    user.value.novelties.length && user.value.novelties.every((b) => b.earned)
)

const titles = computed(() => {
  const base = [...user.value.titles]
  if (hasSpecialist.value) {
    base.push({
      name: 'Breitling Specialist',
      icon: 'professional_Plandetravail_1.png',
      earned: true,
    })
  }
  return base
})

const mainTitle = computed(() => {
  return titles.value[titles.value.length - 1]?.name || ''
})

const novelties = computed(() => user.value.novelties)
const specials = computed(() => user.value.specials)
</script>

<style scoped>
.profile-main {
  padding: 24px 16px;
  margin-top: 80px;
}

.user-info .top-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.edit-link {
  color: #444;
  font-size: 0.9rem;
  text-decoration: none;
}

.user-box {
  display: flex;
  align-items: center;
  margin: 16px 0;
}

.avatar {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  margin-right: 16px;
}

.details h2 {
  margin: 0;
  font-size: 1.2rem;
}

.details p {
  margin: 4px 0;
  color: #444;
}

.details strong {
  font-weight: bold;
  color: #000;
}

/* Progress bar */
.progress-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 24px;
}

.step {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.dot {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background-color: #ccc;
  color: #fff;
  font-size: 0.9rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.dot.done {
  background-color: #000;
}

.label {
  margin-top: 4px;
  font-size: 0.75rem;
  text-align: center;
}

.line {
  flex: 1;
  height: 2px;
  background-color: #ccc;
  margin: 0 6px;
}

.badges-section {
  margin-top: 32px;
}

.badges {
  display: flex;
  gap: 12px;
  flex-wrap: nowrap;
  overflow-x: auto;
  padding: 12px 0;
}

.badges.scrollable::-webkit-scrollbar {
  height: 4px;
}

.badges.scrollable::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 2px;
}
</style>
