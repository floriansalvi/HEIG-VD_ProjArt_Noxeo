<template>
  <div class="profile-form">
    <label>
      Surname
      <input v-model="model.surname" type="text" />
    </label>

    <label>
      First name
      <input v-model="model.firstname" type="text" />
    </label>

    <label>
      Nickname
      <input v-model="model.nickname" type="text" />
    </label>

    <label>
      Email
      <input v-model="model.email" type="email" />
    </label>

    <label>
      Personal website (optional)
      <input v-model="model.website" type="url" />
    </label>

    <label>
      Profile picture (optional)
      <div class="avatar-preview">
        <img :src="model.avatar" alt="avatar" />
      </div>
      <button type="button" @click="changeAvatar">change</button>
    </label>
  </div>
</template>

<script setup>
const model = defineModel()
function changeAvatar() {
  console.log('Change avatar clicked')
}
</script>

<style scoped>
.profile-form {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin: 24px 0;
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

.avatar-preview {
  margin: 12px 0;
}
.avatar-preview img {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
}

button {
  background: black;
  color: white;
  padding: 8px 14px;
  font-size: 0.9rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
</style>
