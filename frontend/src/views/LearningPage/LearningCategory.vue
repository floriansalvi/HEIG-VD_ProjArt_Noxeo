<script setup>
import AppHeader from '@/layouts/AppHeader.vue'
import { ref, onMounted, defineProps, inject } from 'vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { useRouter } from 'vue-router'

const category = ref(null)

const $http = inject('$http');

const router = useRouter()

const props = defineProps({
  id: String
});


const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}

const fetchModules = async () => {
  try {
    await $http.get('/sanctum/csrf-cookie')
    const response = await $http.get(`/api/v1/categories/${props.id}`)

    category.value = response.data.data

  } catch (err) {
    console.log(err.message);
    await router.push('/error')
  }
}

const courses = ref([])

onMounted(() => {
  fetchModules()
})
</script>

<template>
  <div class="onboarding-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <main class="onboarding-main">
      <p class="breadcrumb" v-if="category">
        <router-link to="/learning">Learning</router-link>
        &gt;
        {{ category.title }}
      </p>
      <h1 v-if="category" class="section-title">{{ category.title }}</h1>

      <div v-if="category" class="tiles">
        <router-link 
          v-for="module in category.modules"
          :key="module.id"
          class="tile"
          :style="{ backgroundImage: `url(/img/modules/${module.img_path})` }"
          :to="`/learning/module/${module.id}`"
        >
          <h2>{{ module.title }}</h2>
        </router-link>
      </div>
    </main>
  </div>
</template>

<style scoped>
.onboarding-page {
  background-color: #fff;
  min-height: 100vh;
  padding-top: 80px; /* leave space for header */
}

.onboarding-main {
  padding: 24px 16px;
}

.breadcrumb {
  font-size: 1rem;
  color: #555;
  margin-bottom: 8px;
}

.section-title {
  font-size: 1.4rem;
  font-weight: bold;
  margin-bottom: 24px;
}

.tiles {
  display: grid;
  grid-template-columns: 1fr;
  gap: 16px;
}

.tile {
  position: relative;
  height: 160px;
  background-size: cover;
  background-position: center;
  overflow: hidden;
}

.tiles h2 {
  height: 100%;
  margin: 0;
  color: white;
  padding: 8px 12px;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
  width: 100%;

  font-size: 1.25rem;
  font-weight: 500;
  box-sizing: border-box;
  display: flex;
  align-items: flex-end;
}

a {
  text-decoration: none;
}

@media (min-width: 768px) {
  .tiles {
    grid-template-columns: 1fr 1fr; /* 2 colonnes égales */
  }
  
  .tile {
    height: 200px; /* Hauteur plus grande sur desktop */
  }
  
  .tile h2 {
    font-size: 1.4rem;
  }
}
</style>
