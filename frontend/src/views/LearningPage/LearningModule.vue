<script setup>
import AppHeader from '@/layouts/AppHeader.vue'
import { ref, onMounted, defineProps, inject } from 'vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { useRouter } from 'vue-router'

const module = ref(null)

const $http = inject('$http');

const router = useRouter()

const props = defineProps({
  id: String
});

const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}

const fetchLearningBlocks = async () => {
  try {
    await $http.get('/sanctum/csrf-cookie')
    const response = await $http.get(`/api/v1/modules/${props.id}/learning`)

    module.value = response.data.data
    console.log(module)

  } catch (err) {
    console.log(err.message);
    await router.push('/error')
  }
}

onMounted(() => {
  fetchLearningBlocks()
})
</script>

<template>
  <div class="onboarding-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" />

    <main class="onboarding-main">
      <p class="breadcrumb" v-if="module">
        <router-link to="/learning">Learning</router-link>
        &gt;
        <router-link :to="`/learning/${module.category.id}`">{{ module.category.title }}</router-link>
        &gt;
        {{ module.title }}
      </p>
      <h1 v-if="module" class="section-title">{{ module.title }}</h1>

      <div v-if="module" class="blocks">
        <section v-for="learningBlock in module.learning_blocks" class="block">
          <p v-if="learningBlock.blockable_type === 'App\\Models\\TextBlock'" class="block-text">{{learningBlock.blockable.content}}</p>
          <img v-if="learningBlock.blockable_type === 'App\\Models\\ImageBlock'"
            :src="'/img/learningblock/' + learningBlock.blockable.img_path"
            :alt="learningBlock.blockable.alt_txt"
            class="block-media"
          >
          <video v-if="learningBlock.blockable_type === 'App\\Models\\VideoBlock'" class="block-media" controls>
            <source :src="'/vid/learningblock/' + learningBlock.blockable.vid_path" type="video/mp4">
            <p>Votre navigateur ne supporte pas la vidéo.</p>
          </video>
        </section>
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

.blocks {
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.block {
  position: relative;
  background-size: cover;
  background-position: center;
  overflow: hidden;
}

.block-media {
  width: 48%;
  height: fit-auto;
  max-width: 100%;
  display: block;
  margin: 0 auto;
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
