<script setup>
import { ref, onMounted, inject } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { useRouter } from 'vue-router'
import auth from '@/services/auth'

const $http = inject('$http');

const router = useRouter()

const categories = ref(null)

const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}

const fetchCategories = async () => {
  try {
    await $http.get('/sanctum/csrf-cookie')
    const response = await $http.get('/api/v1/categories')

    categories.value = response.data.data || response.data.data

    console.log(categories.value)
  } catch (err) {
    console.log(err)
  }
}

onMounted(() => {
  fetchCategories()
})
</script>

<template>
  <div class="learning-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <main class="learning-main">
      <h1 class="page-title">Learning</h1>

      <div v-if="categories"
        v-for="category in categories"
        :key="category.title"
        class="section-block"
      >
        <div class="section-header">
          <h2>{{ category.title }}</h2>
          <router-link :to="`/learning/${category.id}`" class="see-all"
            >see all →</router-link
          >
        </div>

        <div class="courses-scroll">
          <router-link 
            v-for="module in category.modules"
            :key="module.id"
            class="course-card"
            :style="{ backgroundImage: `url(/img/modules/${module.img_path})` }"
            :to="`/learning/module/${module.id}`"
          >
              <h3>{{ module.title }}</h3>
          </router-link>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.learning-page {
  background-color: #fff;
  min-height: 100vh;
  padding-top: 80px;
  position: relative;
}

.learning-main {
  padding: 24px 16px;
}

.page-title {
  font-size: 1.6rem;
  font-weight: bold;
  margin-bottom: 24px;
}

.section-block {
  margin-bottom: 32px;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 12px;
}

.section-header h2 {
  font-size: 1.1rem;
  font-weight: bold;
}

.see-all {
  font-size: 0.9rem;
  text-decoration: none;
  color: #000;
}

.courses-scroll {
  display: flex;
  gap: 12px;
  overflow-x: auto;
}

.course-card {
  width: 304px;
  height: 10rem;
  border-radius: 8px;
  background-size: cover;
  background-position: center;
  position: relative;
  flex-shrink: 0;
}

.course-card h3 {
  height: 100%;
  margin: 0;
  color: white;
  padding: 8px 12px;
  background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
  width: 100%;
  border-radius: 0 0 8px 8px;
  font-size: 1.25rem;
  font-weight: 500;
  box-sizing: border-box;
  display: flex;
  align-items: flex-end;
}

a {
  text-decoration: none;
}

@media (max-width: 480px) {
  .course-card {
    width: 140px; /* Largeur légèrement réduite sur très petits écrans */
  }
  
  .course-card h3 {
    font-size: 0.8rem;
    padding: 6px 8px;
  }
}

@media (max-width: 360px) {
  .course-card {
    width: 120px; /* Encore plus petit sur très petits écrans */
  }
}
</style>
