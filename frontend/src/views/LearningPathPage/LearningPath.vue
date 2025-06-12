<template>
  <div class="learning-path">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <div class="scroller" @wheel.prevent="handleScroll">
      <div class="learning-header">
        <h1>Learning path</h1>
        <p>scroll your path !</p>
      </div>

      <div class="module-block" v-if="modules.length">
        <div class="arc-wrapper">
          <!-- Arc radial -->
          <svg viewBox="0 0 200 200" class="arc-svg">
            <g>
              <line
                v-for="i in tickCount"
                :key="i"
                x1="100"
                y1="10"
                x2="100"
                y2="20"
                :stroke="tickColor(i - 1)"
                stroke-width="2"
                stroke-linecap="round"
                :transform="`rotate(${tickAngle(i + 95)} 100 100)`"
              />
            </g>
          </svg>

          <!-- Texte centré dans l’arc -->
          <div class="text-center-inside">
            <h2>{{ currentModule.title }}</h2>
            <p class="meta">
              Onboarding {{ (currentModule.points || 0).toLocaleString() }} PTS
            </p>
            <p class="desc">{{ currentModule.description }}</p>
          </div>
        </div>

        <!-- Bouton en bas à droite -->
        <div class="start-btn-container">
          <button
            @click="startStep"
            class="start-btn"
          >
            Start {{ currentModule.type.toLowerCase() }}
          </button>
        </div>
      </div>

      <div v-else class="loading-text">Loading modules...</div>
    </div>
  </div>
</template>


<script setup>
import { ref, computed, onMounted, inject } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const $http = inject('$http');

const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)

const modules = ref([])  // modules récupérés de l'API
const activeIndex = ref(0)

const currentModule = computed(() => {
  if (modules.value.length === 0) return { title: '', description: '', points: 0, type: '' }
  return modules.value[activeIndex.value]
})

const tickCount = 40

const tickAngle = (i) => {
  const start = -110
  const end = 110
  return start + ((end - start) * i) / (tickCount - 1)
}

const tickColor = (i) => {
  const ratio = (activeIndex.value + 1) / modules.value.length
  const indexLimit = Math.floor(tickCount * ratio)

  if (i < indexLimit - 1) return '#f4c542'
  if (i === indexLimit - 1) return '#000'
  return '#ddd'
}

const startStep = () => {

  const type = (currentModule.value?.type || '').toLowerCase()
  const firstStep = currentModule.value?.steps?.[0]

  if (!firstStep) {
    console.warn('No implemented')
    return
  }

  const stepId = firstStep.id

  if (type === 'test') {
    router.push(`/test/${stepId}`)
  } else {
    console.warn('No implemented')
  }
}

let scrollCooldown = false
function handleScroll(e) {
  if (scrollCooldown) return
  scrollCooldown = true

  const direction = e.deltaY > 0 ? 1 : -1
  const nextIndex = activeIndex.value + direction

  if (nextIndex >= 0 && nextIndex < modules.value.length) {
    activeIndex.value = nextIndex
  }

  setTimeout(() => {
    scrollCooldown = false
  }, 500)
}

const fetchSteps = async () => {
  try {
    await $http.get('/sanctum/csrf-cookie') // si nécessaire
    const response = await $http.get('api/v1/steps') // ta route Laravel

    // Exemple de structure attendue : 
    // response.data.data = [
    //   { modules: [ { title, description, steps: [{ total_points }] ... } ] }
    // ]

    // On aplatie ici pour récupérer tous les modules de toutes les catégories en un seul tableau
    const categories = response.data.data

    // Extraire tous les modules dans un tableau à plat
    const allModules = categories.flatMap(category => {
  return category.modules.map(module => {
    // calculer le total des points sur le module (somme des total_points des steps)
    const modulePoints = module.steps.reduce((acc, step) => acc + (step.total_points || 0), 0)

    // prendre le type de la première step ou 'lesson' par défaut
    const stepType = module.steps.length > 0 ? module.steps[0].type : 'lesson'

    return {
      id: module.id,
      title: module.title,
      description: module.description,
      type: stepType,
      points: modulePoints,
      steps: module.steps,
    }
  })
})

    modules.value = allModules

  } catch (err) {
    console.error(err)
  }
}

onMounted(fetchSteps)
</script>


<style scoped>
.learning-path {
  background: #fff;
  min-height: 100vh;
  overflow: hidden;
  position: relative;
  z-index: 0;
}

.learning-path::before {
  content: '';
  position: absolute;
  top: 4rem;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('@/assets/breitling_store.png');
  background-size: cover;
  background-position: center;
  opacity: 0.4;
  z-index: 0;
  pointer-events: none;
}

.learning-path::after {
  content: '';
  position: absolute;
  top: 4rem;
  left: 0;
  width: 100%;
  height: 100%;
  background: white;
  opacity: 0.4;
  z-index: 1;
  pointer-events: none;
}

.scroller {
  height: calc(100vh - 80px);
  padding-top: 80px;
  display: flex;
  flex-direction: column;
  align-items: center;
  position: relative;
  z-index: 2;
}

.learning-header {
  text-align: left;
  width: 100%;
  max-width: 300px;
  padding: 30px;
}

.learning-header h1 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #000;
  margin-left: -1rem;
}

.learning-header p {
  font-size: 0.9rem;
  color: #555;
  margin-top: -1rem;
  margin-left: -1rem;
}

.module-block {
  position: relative;
  width: 100%;
  max-width: 420px;
  min-height: 440px;
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.arc-wrapper {
  position: relative;
  width: 100%;
  height: 100%;
  z-index: 3;
}

.arc-wrapper::before {
  content: '';
  clip-path: circle(50% at 50% 50%);
  position: absolute;
  top: -46px;
  left: -135px;
  width: 460px;
  height: 420px;
  background-image: url('@/assets/cadran.png'); /* ← image cadran détourée */
  background-size: cover;
  background-position: center;
  z-index: 0;
  pointer-events: none;
}

.arc-svg {
  position: absolute;
  left: -90px;
  top: 0px;
  width: 350px;
  height: 320px;
  transform: rotate(-90deg);
  z-index: 1;
}

.text-center-inside {
  position: absolute;
  top: 10rem;
  left: 6rem;
  transform: translate(-45%, -50%);
  width: 180px;
  text-align: left;
  z-index: 2;
}

.text-center-inside h2 {
  font-size: 1.4rem;
  font-weight: bold;
  margin-bottom: 0.4rem;
  color: #000;
}

.text-center-inside .meta {
  font-size: 0.9rem;
  color: #444;
  margin-bottom: 1rem;
}

.text-center-inside .desc {
  font-size: 1rem;
  line-height: 1.4;
  margin-bottom: 1.5rem;
  color: #333;
}

.start-btn-container {
  width: 80%;
  display: flex;
  justify-content: flex-end;
  padding: 0 1rem 1rem;
  margin-top: auto;
}

.start-btn {
  background: #f4c542;
  border: none;
  padding: 12px 24px;
  font-weight: bold;
  border-radius: 6px;
  cursor: pointer;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
</style>
