<script setup>
import { ref, onMounted, inject } from 'vue'
import { useRouter } from 'vue-router'
import auth from '@/services/auth.js'

const $http = inject('$http');

const router = useRouter()
const loading = ref(false)

const error = ref('')

const surname = ref('')
const firstname = ref('')
const nickname = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')
const key = ref(sessionStorage.getItem('key_id') || '')

const handleRegistration = async () => {
  loading.value = true
  try {
    await $http.get('/sanctum/csrf-cookie');
    await auth.registerUser({
      surname: surname.value,
      firstname: firstname.value,
      nickname: nickname.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value,
      registration_key_id: key.value
    })
    sessionStorage.removeItem('key_id')
    key.value = ''
    await router.push('/verify-email')
  } catch (err) {
  console.error('Registration error:', err); // 👈 Ajoute ceci

  if (err?.response?.status === 422) {
    const errors = err.response.data.errors || {};
    error.value = Object.values(errors).flat().join(', ');
  } else if (err?.response?.status === 500) {
    // 👇 Optionnel mais utile
    error.value = 'Erreur serveur (500) : ' + (err.response?.data?.message || 'Internal Server Error');
  } else {
    error.value = 'Login failed. Please try again.';
  }

  loading.value = false;
}
}

onMounted(() => {
  if (!key.value) {
    router.push('/key')
  }
})

</script>

<template>
  <h1 v-if="key">{{ key }}</h1>
  <div class="register-page">
    <div class="register-header">
      <img
        src="@/assets/ecusson-bleague-yellow.png"
        alt="B League Logo"
        class="logo"
      />
    </div>

    <div class="register-form">
      <div class="input-row">
        <input
          type="text"
          v-model="surname"
          placeholder="Surname"
          class="input"
        />
        <input
          type="text"
          v-model="firstname"
          placeholder="Firstname"
          class="input"
        />
      </div>

      <input
          type="text"
          v-model="nickname"
          placeholder="Nickname"
          class="input"
        />
      <input
          type="email"
          v-model="email"
          placeholder="Email"
          class="input"
        />
      <input
          type="password"
          v-model="password"
          placeholder="Password"
          class="input"
        />
      <input
          type="password"
          v-model="passwordConfirmation"
          placeholder="Confirm password"
          class="input"
      />

      <p v-if="error">{{ error }}</p>

      <p class="legal-links">
        I agree to the
        <router-link to="/terms">Terms</router-link> and
        <router-link to="/privacy">Privacy Policy</router-link>.
      </p>

      <button class="btn btn-primary" @click="handleRegistration" :disabled="loading">
        <span v-if="loading">Registering...</span>
        <span v-else>Register</span>
      </button>

      <p class="login-link">
        <router-link to="/">I already have an account</router-link>
      </p>
    </div>
  </div>
</template>

<style scoped>
.register-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: var(--color-white);
}

.register-header {
  background-color: var(--color-blue);
  width: 100%;
  padding: 64px 0;
  display: flex;
  justify-content: center;
}

.logo {
  width: 160px;
  max-width: 70%;
  height: auto;
}

.register-form {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
  padding: var(--space-lg);
  max-width: 500px;
  width: 100%;
  margin: 0 auto;
  box-sizing: border-box;
}

.input {
  width: 100%;
  padding: var(--space-sm);
  font-size: 1rem;
  border: 1px solid black;
  font-family: var(--font-family-main);
  border-radius: 4px;
  box-sizing: border-box;
}

/* Row for surname + name */
.input-row {
  display: flex;
  gap: var(--space-sm);
}

.input-row .input {
  flex: 1;
}

/* Checkbox */
.checkbox-container {
  display: flex;
  align-items: flex-start;
  gap: var(--space-sm);
  font-size: 0.9rem;
  line-height: 1.4;
  color: var(--color-black);
}

.checkbox-container input {
  margin-top: 4px;
}

.checkbox-container a {
  text-decoration: underline;
  color: var(--color-blue);
}

/* Button */
.btn-primary {
  width: 100%;
  background-color: black;
  color: white;
  padding: var(--space-sm);
  font-size: 1rem;
  font-family: var(--font-family-main);
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

/* Link */

.legal-links {
  font-size: 0.8rem;
  color: #444;
  text-align: center;
  margin-top: 16px;
}
.legal-links a {
  color: var(--color-blue);
  text-decoration: underline;
}

.login-link {
  text-align: center;
  font-size: 0.85rem;
  margin-top: var(--space-sm);
}

.login-link a {
  color: var(--color-blue);
  text-decoration: none;
  font-weight: var(--font-medium);
}

/* Responsive */
@media (min-width: 768px) {
  .register-header {
    padding: 80px 0;
  }

  .register-form {
    max-width: 520px;
  }
}
</style>
