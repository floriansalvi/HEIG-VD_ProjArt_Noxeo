<template>
  <div class="password-form">
    <label>
      Current password
      <input v-model="model.current" type="password" />
    </label>

    <label>
      New password
      <input v-model="model.new" type="password" />
    </label>

    <label>
      Confirm new password
      <input v-model="model.confirm" type="password" />
    </label>
  </div>
</template>

<script setup>
const model = defineModel()
</script>

<style scoped>
.password-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-top: 16px;
}

label {
  display: flex;
  flex-direction: column;
  font-size: 0.9rem;
  color: #222;
}

input {
  margin-top: 6px;
  padding: 10px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
</style>
