<template>
  <div class="settings-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <main class="settings-main">
      <div class="section-header">
        <RouterLink to="/profile" class="retour">
          &#8592;
          <span>Return</span>
        </RouterLink>
      </div>

      <h1>Settings</h1>

      <ProfileForm v-model="form" />
      <PasswordForm v-model="passwords" />

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
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter, RouterLink } from 'vue-router'

import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import ProfileForm from '@/components/Settings/ProfileForm.vue'
import PasswordForm from '@/components/Settings/PasswordForm.vue'
import DeleteConfirmModal from '@/components/Settings/DeleteConfirmModal.vue'

const router = useRouter()
const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)

const form = ref({
  surname: '',
  firstname: '',
  nickname: '',
  email: '',
  website: '',
  avatar: '/assets/image.png',
})

const passwords = ref({
  current: '',
  new: '',
  confirm: '',
})

const showDeleteModal = ref(false)

onMounted(async () => {
  try {
    const { data } = await axios.get('/api/user', { withCredentials: true })
    form.value = {
      surname: data.surname,
      firstname: data.firstname,
      nickname: data.nickname,
      email: data.email,
      website: data.website ?? '',
      avatar: data.avatar ?? '/assets/image.png',
    }
  } catch (err) {
    console.error('❌ Failed to load user:', err)
  }
})

async function save() {
  try {
    await axios.put('/api/v1/user/update-profile', form.value)
    alert('✅ Profile updated')
  } catch (err) {
    console.error('❌ Failed to update profile:', err)
    alert('Failed to update profile')
  }

  const { current, new: newPass, confirm } = passwords.value
  if (current && newPass && newPass === confirm) {
    try {
      await axios.put('/api/v1/user/update-password', {
        current_password: current,
        new_password: newPass,
      })
      alert('✅ Password changed')
      passwords.value = { current: '', new: '', confirm: '' }
    } catch (err) {
      console.error('❌ Failed to change password:', err)
      alert('Password change failed')
    }
  } else if (current || newPass || confirm) {
    alert('⚠️ All password fields must be filled and match')
  }
}

async function confirmDelete() {
  try {
    await axios.delete('/api/v1/user/delete')
    alert('✅ Account deleted')
    router.push('/login')
  } catch (err) {
    console.error('❌ Failed to delete account:', err)
    alert('Account deletion failed')
  } finally {
    showDeleteModal.value = false
  }
}
</script>

<style scoped>
.settings-main {
  padding: 24px 16px;
  margin-top: 80px;
}

.section-header {
  display: flex;
  justify-content: flex-start;
  margin-bottom: 1rem;
}

.retour {
  font-size: 0.95rem;
  color: #444;
  text-decoration: none;
  margin-top: 2rem;
}

.actions {
  margin-top: 24px;
  display: flex;
  flex-direction: column;
  gap: 12px;
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

.delete-btn {
  background: none;
  color: #444;
  border: none;
  text-decoration: underline;
  font-size: 0.9rem;
  cursor: pointer;
}

.legal {
  font-size: 0.8rem;
  color: #666;
  margin-top: 12px;
  text-align: center;
}
</style>
