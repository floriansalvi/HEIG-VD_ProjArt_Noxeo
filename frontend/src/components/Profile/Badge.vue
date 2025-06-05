<template>
  <div class="badge" :class="{ disabled: !badge.earned }">
    <img
      :src="`/assets/badges/${badge.icon || getIcon(badge.name)}`"
      :alt="badge.name"
    />
    <p class="label">{{ badge.name }}</p>
  </div>
</template>

<script setup>
defineProps({
  badge: {
    type: Object,
    required: true,
  },
})

function getIcon(name) {
  // fallback si badge.icon n'est pas défini
  return name.toLowerCase().replaceAll(' ', '-') + '.png'
}
</script>

<style scoped>
.badge {
  display: flex;
  flex-direction: column;
  align-items: center;
  min-width: 80px;
  opacity: 1;
  transition: opacity 0.3s;
}

.badge img {
  width: 56px;
  height: 70px;
  object-fit: contain;
}

.badge .label {
  margin-top: 6px;
  font-size: 0.75rem;
  text-align: center;
  color: #111;
}

.badge.disabled {
  opacity: 0.4;
}
</style>
