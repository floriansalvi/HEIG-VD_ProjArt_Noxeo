<template>
  <div class="settings-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <main class="settings-main">
      <h1>Settings</h1>

      <section>
        <div class="section-header">
          <RouterLink to="/profile" class="edit">
            edit <span>&#9998;</span>
          </RouterLink>
        </div>
        <ProfileForm v-model="form" />
      </section>

      <section>
        <PasswordForm v-model="passwords" />
      </section>

      <div class="actions">
        <button class="save-btn" @click="save">Save changes</button>
        <button class="delete-btn" @click="showDeleteModal = true">
          Delete account
        </button>
        <p class="legal">
          Click here to see our
          <RouterLink to="/terms">Terms of use</RouterLink>
          and our
          <RouterLink to="/privacy">Privacy Policy</RouterLink>
        </p>
      </div>
    </main>

    <DeleteConfirmModal
      v-if="showDeleteModal"
      @close="showDeleteModal = false"
      @confirm="confirmDelete"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import ProfileForm from '@/components/settings/ProfileForm.vue'
import PasswordForm from '@/components/settings/PasswordForm.vue'
import DeleteConfirmModal from '@/components/Settings/DeleteConfirmModal.vue'
import { RouterLink } from 'vue-router'

const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)

const form = ref({
  surname: 'Michael',
  firstname: 'Meyer',
  nickname: 'Michael',
  email: 'meyer.michael@breitling.ch',
  website: '',
  avatar: '/assets/image.png',
})

const passwords = ref({
  current: '',
  new: '',
  confirm: '',
})

const showDeleteModal = ref(false)

function save() {
  console.log('Saving profile', form.value)
  console.log('Changing password', passwords.value)
}

function confirmDelete() {
  console.log('User confirmed delete')
  showDeleteModal.value = false
  // Tu pourras ici appeler l'API quand elle sera prête
}
</script>

<style scoped>
.settings-main {
  padding: 24px 16px;
  margin-top: 80px;
}
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.edit {
  font-size: 0.9rem;
  color: #444;
  text-decoration: none;
}
.actions {
  margin-top: 24px;
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.delete-btn {
  background: none;
  color: #444;
  border: none;
  text-decoration: underline;
  font-size: 0.9rem;
  cursor: pointer;
}
.save-btn {
  background: black;
  color: white;
  padding: 14px;
  font-size: 1rem;
  font-weight: bold;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}
.legal {
  font-size: 0.8rem;
  color: #666;
  margin-top: 12px;
  text-align: center;
}
</style>
