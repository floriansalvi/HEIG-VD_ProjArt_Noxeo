<template>
  <div class="scroller" @wheel.prevent="handleScroll">
    <div
      v-for="(module, index) in modules"
      :key="index"
      class="scroll-item"
      :class="{ active: index === activeIndex }"
    >
      <div class="line"></div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
  modules: Array,
})

const emit = defineEmits(['update:active'])

const activeIndex = ref(0)
let scrollCooldown = false

function handleScroll(e) {
  if (scrollCooldown) return
  scrollCooldown = true

  if (e.deltaY > 0 && activeIndex.value < props.modules.length - 1) {
    activeIndex.value++
  } else if (e.deltaY < 0 && activeIndex.value > 0) {
    activeIndex.value--
  }

  emit('update:active', activeIndex.value)

  setTimeout(() => {
    scrollCooldown = false
  }, 600)
}

onMounted(() => {
  emit('update:active', activeIndex.value)
})
</script>

<style scoped>
.scroller {
  width: 60%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 200px;
  padding-top: 50px;
  z-index: 2;
}
.scroll-item {
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.scroll-item .line {
  width: 8px;
  height: 60px;
  background: #ccc;
  border-radius: 4px;
}
.scroll-item.active .line {
  background: black;
  height: 80px;
}
</style>
