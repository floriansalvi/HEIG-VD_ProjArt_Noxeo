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
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import ProfileForm from '@/components/settings/ProfileForm.vue'
import PasswordForm from '@/components/settings/PasswordForm.vue'
import DeleteConfirmModal from '@/components/settings/DeleteConfirmModal.vue'
import { RouterLink } from 'vue-router'

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

// Récupère les données de l'utilisateur connecté
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
    console.error('❌ Erreur chargement user :', err)
  }
})

async function save() {
  try {
    await axios.put('/api/v1/user/update-profile', form.value)
    alert('✅ Profil mis à jour')
  } catch (err) {
    console.error('❌ Erreur update-profile :', err)
    alert('Échec de la mise à jour du profil')
  }

  const { current, new: newPass, confirm } = passwords.value
  if (current && newPass && newPass === confirm) {
    try {
      await axios.put('/api/v1/user/update-password', {
        current_password: current,
        new_password: newPass,
      })
      alert('✅ Mot de passe modifié')
      passwords.value = { current: '', new: '', confirm: '' }
    } catch (err) {
      console.error('❌ Erreur update-password :', err)
      alert('Échec du changement de mot de passe')
    }
  } else if (current || newPass || confirm) {
    alert(
      '⚠️ Tous les champs du mot de passe doivent être remplis et identiques'
    )
  }
}

async function confirmDelete() {
  try {
    await axios.delete('/api/v1/user/delete')
    alert('✅ Compte supprimé')
    router.push('/login')
  } catch (err) {
    console.error('❌ Erreur suppression compte :', err)
    alert('Impossible de supprimer le compte')
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
